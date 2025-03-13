<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyToken
{
    public function handle(Request $request, Closure $next)
    {
        $authorizationHeader = $request->header('Authorization');

        if (!$authorizationHeader || !preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $matches[1];

        // Implement your token verification logic here
        if ($token !== 'Sman1margaasih*') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
