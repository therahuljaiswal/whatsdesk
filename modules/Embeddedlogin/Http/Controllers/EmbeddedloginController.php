<?php

namespace Modules\Embeddedlogin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EmbeddedloginController extends Controller
{
    /**
     * Facebook Graph API base URL
     */
    private static $graphApiVersion = 'v21.0';

    /**
     * Handle the callback from Facebook Embedded Signup
     * 
     * This receives the authorization code from the FB JS SDK,
     * exchanges it for an access token, then auto-configures
     * the company's WhatsApp settings.
     */
    public function handleCallback(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = $request->input('code');
        $appId = config('embeddedlogin.app_id');
        $appSecret = config('embeddedlogin.app_secret');

        if (empty($appId) || empty($appSecret)) {
            return response()->json([
                'success' => false,
                'message' => __('embeddedlogin::general.not_configured'),
            ], 400);
        }

        try {
            // Step 1: Exchange code for access token
            $tokenData = $this->exchangeCodeForToken($code, $appId, $appSecret);
            if (!$tokenData) {
                return response()->json([
                    'success' => false,
                    'message' => __('embeddedlogin::general.error_token_exchange'),
                ], 400);
            }

            $accessToken = $tokenData['access_token'];

            // Step 2: Debug the token to get granted scopes and WABA info
            $debugData = $this->debugToken($accessToken, $appId, $appSecret);

            // Step 3: Extract WABA ID from debug data (granular_scopes)
            $wabaId = $this->extractWabaId($debugData);
            if (!$wabaId) {
                // Fallback: try to get WABA from shared WABAs
                $wabaId = $this->getSharedWabaId($accessToken);
            }

            if (!$wabaId) {
                return response()->json([
                    'success' => false,
                    'message' => __('embeddedlogin::general.error_fetch_waba'),
                ], 400);
            }

            // Step 4: Get phone numbers for this WABA
            $phoneData = $this->getPhoneNumbers($wabaId, $accessToken);
            if (!$phoneData) {
                return response()->json([
                    'success' => false,
                    'message' => __('embeddedlogin::general.error_fetch_phone'),
                ], 400);
            }

            $phoneNumberId = $phoneData['id'];
            $phoneNumber = $phoneData['display_phone_number'] ?? $phoneData['verified_name'] ?? '';

            // Step 5: Subscribe the app to the WABA webhooks
            $this->subscribeAppToWaba($wabaId, $accessToken);

            // Step 6: Register the phone number for Cloud API
            $this->registerPhoneNumber($phoneNumberId, $accessToken);

            // Step 7: Save all config to the company
            $company = $this->getCompany();
            if (!$company) {
                return response()->json([
                    'success' => false,
                    'message' => 'Company not found.',
                ], 404);
            }

            $company->setConfig('whatsapp_permanent_access_token', $accessToken);
            $company->setConfig('whatsapp_phone_number_id', $phoneNumberId);
            $company->setConfig('whatsapp_business_account_id', $wabaId);
            $company->setConfig('whatsapp_webhook_verified', 'yes');
            $company->setConfig('whatsapp_settings_done', 'yes');

            Log::info('Embedded Signup completed successfully', [
                'company_id' => $company->id,
                'waba_id' => $wabaId,
                'phone_number_id' => $phoneNumberId,
            ]);

            return response()->json([
                'success' => true,
                'message' => __('embeddedlogin::general.success'),
                'data' => [
                    'waba_id' => $wabaId,
                    'phone_number_id' => $phoneNumberId,
                    'phone_number' => $phoneNumber,
                ],
            ]);

        } catch (\Throwable $th) {
            Log::error('Embedded Signup failed', [
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => __('embeddedlogin::general.connection_failed') . ' ' . $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Exchange the authorization code for an access token
     */
    private function exchangeCodeForToken(string $code, string $appId, string $appSecret): ?array
    {
        $url = 'https://graph.facebook.com/' . self::$graphApiVersion . '/oauth/access_token';

        $response = Http::get($url, [
            'client_id' => $appId,
            'client_secret' => $appSecret,
            'code' => $code,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['access_token'])) {
                Log::info('Token exchange successful');
                return $data;
            }
        }

        Log::error('Token exchange failed', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return null;
    }

    /**
     * Debug the access token to get granted scopes and associated assets
     */
    private function debugToken(string $accessToken, string $appId, string $appSecret): ?array
    {
        $url = 'https://graph.facebook.com/' . self::$graphApiVersion . '/debug_token';

        $response = Http::get($url, [
            'input_token' => $accessToken,
            'access_token' => $appId . '|' . $appSecret,
        ]);

        if ($response->successful()) {
            return $response->json()['data'] ?? null;
        }

        Log::error('Token debug failed', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return null;
    }

    /**
     * Extract WABA ID from the debug token response (granular_scopes)
     */
    private function extractWabaId(?array $debugData): ?string
    {
        if (!$debugData || !isset($debugData['granular_scopes'])) {
            return null;
        }

        foreach ($debugData['granular_scopes'] as $scope) {
            if (
                in_array($scope['scope'], ['whatsapp_business_management', 'whatsapp_business_messaging'])
                && isset($scope['target_ids'])
                && count($scope['target_ids']) > 0
            ) {
                return $scope['target_ids'][0];
            }
        }

        return null;
    }

    /**
     * Fallback: Get shared WABA IDs using the business token
     */
    private function getSharedWabaId(string $accessToken): ?string
    {
        // Try to get WABAs from the user's shared accounts
        $url = 'https://graph.facebook.com/' . self::$graphApiVersion . '/me/businesses';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get($url);

        if ($response->successful()) {
            $businesses = $response->json()['data'] ?? [];
            foreach ($businesses as $business) {
                $businessId = $business['id'];

                // Get WABAs for this business
                $wabaUrl = 'https://graph.facebook.com/' . self::$graphApiVersion . '/' . $businessId . '/owned_whatsapp_business_accounts';
                $wabaResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                ])->get($wabaUrl);

                if ($wabaResponse->successful()) {
                    $wabas = $wabaResponse->json()['data'] ?? [];
                    if (count($wabas) > 0) {
                        return $wabas[0]['id'];
                    }
                }

                // Also try client WABAs
                $clientWabaUrl = 'https://graph.facebook.com/' . self::$graphApiVersion . '/' . $businessId . '/client_whatsapp_business_accounts';
                $clientWabaResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                ])->get($clientWabaUrl);

                if ($clientWabaResponse->successful()) {
                    $clientWabas = $clientWabaResponse->json()['data'] ?? [];
                    if (count($clientWabas) > 0) {
                        return $clientWabas[0]['id'];
                    }
                }
            }
        }

        return null;
    }

    /**
     * Get phone numbers associated with a WABA
     */
    private function getPhoneNumbers(string $wabaId, string $accessToken): ?array
    {
        $url = 'https://graph.facebook.com/' . self::$graphApiVersion . '/' . $wabaId . '/phone_numbers';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get($url);

        if ($response->successful()) {
            $data = $response->json()['data'] ?? [];
            if (count($data) > 0) {
                Log::info('Phone numbers fetched', ['count' => count($data)]);
                return $data[0]; // Return the first phone number
            }
        }

        Log::error('Failed to fetch phone numbers', [
            'waba_id' => $wabaId,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return null;
    }

    /**
     * Subscribe the app to the WABA webhooks
     */
    private function subscribeAppToWaba(string $wabaId, string $accessToken): bool
    {
        $url = 'https://graph.facebook.com/' . self::$graphApiVersion . '/' . $wabaId . '/subscribed_apps';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post($url);

        if ($response->successful()) {
            Log::info('App subscribed to WABA webhooks', ['waba_id' => $wabaId]);
            return true;
        }

        Log::warning('Failed to subscribe app to WABA', [
            'waba_id' => $wabaId,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return false;
    }

    /**
     * Register the phone number for Cloud API usage
     */
    private function registerPhoneNumber(string $phoneNumberId, string $accessToken): bool
    {
        $url = 'https://graph.facebook.com/' . self::$graphApiVersion . '/' . $phoneNumberId . '/register';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post($url, [
            'messaging_product' => 'whatsapp',
            'pin' => '123456', // Default 6-digit PIN for two-step verification
        ]);

        if ($response->successful()) {
            Log::info('Phone number registered for Cloud API', ['phone_number_id' => $phoneNumberId]);
            return true;
        }

        // Registration might fail if already registered - that's OK
        Log::warning('Phone number registration response', [
            'phone_number_id' => $phoneNumberId,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return false;
    }
}
