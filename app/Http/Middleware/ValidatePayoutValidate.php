<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidatePayoutValidate
{
    /**
     * Handle an incoming request and validate the input.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Validate the request input
        $request->validate([
            'phrn' => 'required|string',
            'principal_amount' => 'required|numeric|min:1',
            'iso_originating_country' => 'required|string|size:2',
            'iso_destination_country' => 'required|string|size:2',
            'sender_last_name' => 'required|string',
            'sender_first_name' => 'required|string',
            'sender_middle_name' => 'nullable|string',
            'receiver_last_name' => 'required|string',
            'receiver_first_name' => 'required|string',
            'receiver_middle_name' => 'nullable|string',
            'payout_partner_code' => 'required|string',
        ]);

        // Proceed with the request
        return $next($request);
    }
}
