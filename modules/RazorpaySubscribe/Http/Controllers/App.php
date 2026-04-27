<?php

namespace Modules\RazorpaySubscribe\Http\Controllers;

use App\Models\User;

class App
{
    /**
     * Validates if the user can use the app based on pricing restrictions.
     * This method is called dynamically by the core application.
     */
    public function validate(User $user)
    {
        // For Razorpay one-time purchase/basic integration, we don't block access 
        // to the plan list or force a redirect here, so returning true is sufficient.
        return true;
    }
}
