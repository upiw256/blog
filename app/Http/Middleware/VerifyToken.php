<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        // Periksa keberadaan dan format token
        if (!str_starts_with($token, env('BARRIER_TOKEN'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
