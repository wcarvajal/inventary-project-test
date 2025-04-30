<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateService
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        
        if ($apiKey !== config('services.api_key')) {
            return response()->json([
                'errors' => [
                    [
                        'title' => 'Unauthorized',
                        'detail' => 'Invalid API Key',
                        'status' => '401'
                    ]
                ]
            ], 401);
        }

        return $next($request);
    }
}