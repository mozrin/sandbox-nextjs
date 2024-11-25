<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyApiToken
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
        $token = $request->header('X-API-TOKEN');

        // Log the request to verify middleware execution
        Log::info('Middleware check: ', ['token' => $token]);

        // You can store the token in the environment file or a secure location
        if ($token !== env('API_LOG_TOKEN')) {
            Log::warning('Unauthorized access attempt: ', ['token' => $token]);
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
