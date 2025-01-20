<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user has 'admin' role
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        // Return forbidden response if user is not an admin
        return response()->json(['error' => 'Unauthorized'], 403);
    }
}