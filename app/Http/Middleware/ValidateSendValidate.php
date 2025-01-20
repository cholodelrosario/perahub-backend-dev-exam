<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateSendValidate
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
            'partner_reference_number' => 'required|string',
            'principal_amount' => 'required|numeric|min:1',
            'service_fee' => 'required|numeric|min:0',
            'iso_currency' => 'required|string|size:3',
            'conversion_rate' => 'required|numeric|min:0',
            'iso_originating_country' => 'required|string|size:2',
            'iso_destination_country' => 'required|string|size:2',
            'sender_last_name' => 'required|string',
            'sender_first_name' => 'required|string',
            'sender_middle_name' => 'nullable|string',
            'receiver_last_name' => 'required|string',
            'receiver_first_name' => 'required|string',
            'receiver_middle_name' => 'nullable|string',
            'sender_birth_date' => 'required|date',
            'sender_birth_place' => 'required|string',
            'sender_birth_country' => 'required|string|size:2',
            'sender_gender' => 'required|in:MALE,FEMALE',
            'sender_relationship' => 'required|string',
            'sender_purpose' => 'required|string',
            'sender_source_of_fund' => 'required|string',
            'sender_occupation' => 'required|string',
            'sender_employment_nature' => 'required|string',
            'send_partner_code' => 'required|string',
        ]);

        // Proceed with the request
        return $next($request);
    }
}