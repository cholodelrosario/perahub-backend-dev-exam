<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateSendConfirm
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
            'send_validate_reference_number' => 'required|string',
        ]);

        // Proceed with the request
        return $next($request);
    }
}