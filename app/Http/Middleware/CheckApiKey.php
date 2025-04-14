<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('x-api-key');
        $validApiKey = env('X_API_KEY');

        if (!$apiKey || $apiKey !== $validApiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API key'
            ], 401);
        }

        return $next($request);
    }
}
