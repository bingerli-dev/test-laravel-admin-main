<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;

class VerifyApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $clientId = $request->header('client_id');
        $clientSecret = $request->header('client_secret');

        if (!$clientId || !$clientSecret) {
            return response()->json([
                'message' => 'Missing client credentials',
            ], 401);
        }

        $apiClient = ApiKey::where('client_id', $clientId)
            ->where('is_active', true)
            ->first();

        if (!$apiClient || $apiClient->client_secret !== $clientSecret) {
            return response()->json([
                'message' => 'Invalid client credentials',
            ], 401);
        }

        // Add the API client to the request for later use if needed
        $request->attributes->set('api_client', $apiClient);

        return $next($request);
    }
}
