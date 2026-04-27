<?php

namespace Modules\RazorpaySubscribe\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Razorpay\Api\Api;
use App\Models\Plans;
use Illuminate\Support\Facades\Log;

class Main extends Controller
{
    private function getApi()
    {
        $key = env('RAZORPAY_KEY', '');
        $secret = env('RAZORPAY_SECRET', '');
        return new Api($key, $secret);
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer',
        ]);

        $plan = Plans::findOrFail($request->plan_id);
        
        $api = $this->getApi();

        try {
            // Price usually needs conversion from major to minor units
            // Assuming config site_currency is INR, USD, etc.
            $currency = strtoupper(config('settings.site_currency', 'INR'));
            
            $orderData = [
                'receipt'         => 'rcptid_' . $plan->id . '_' . auth()->user()->id . '_' . time(),
                'amount'          => intval($plan->price * 100), // Razorpay accepts amounts in paise/cents
                'currency'        => $currency,
            ];

            $razorpayOrder = $api->order->create($orderData);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $orderData['amount'],
                'currency' => $orderData['currency'],
                'plan_name' => $plan->name,
                'key' => env('RAZORPAY_KEY'),
                'user_name' => auth()->user()->name,
                'user_email' => auth()->user()->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay Order Creation Failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        $success = true;
        $error = "Payment Failed";

        if (empty($request->razorpay_payment_id) === false) {
            $api = $this->getApi();

            try {
                $attributes = array(
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                );

                $api->utility->verifyPaymentSignature($attributes);
            } catch (\Exception $e) {
                $success = false;
                $error = 'Razorpay Signature Verification Failed: ' . $e->getMessage();
                Log::error($error);
            }
        } else {
            $success = false;
            $error = "Payment ID not found in the request.";
        }

        if ($success === true) {
            $plan = Plans::findOrFail($request->plan_id);
            
            // Assign user to plan
            $user = auth()->user();
            $user->plan_id = $plan->id;
            
            // Standard behavior in this app
            $user->plan_status = null;
            $user->cancel_url = '';
            
            $user->update();

            return redirect()->route('plans.current')->withStatus(__('Plan updated successfully via Razorpay!'));
        } else {
            return redirect()->route('plans.current')->withError($error);
        }
    }
}
