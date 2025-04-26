<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Get the Origin from the request header
        $origin = $request->headers->get('Origin');

        // List of allowed origins
        $allowedOrigins = [
            'https://lulus.sman1margaasih.sch.id',
            'http://192.168.18.22', // Ensure only necessary domains are listed
        ];

        // Check if the Origin is valid and set Access-Control-Allow-Origin
        if (in_array($origin, $allowedOrigins)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
        } else {
            // If the origin is not in the list, do not set the header
            $response->headers->remove('Access-Control-Allow-Origin');
        }

        // Set other CORS headers
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With');
        $response->headers->set('Access-Control-Allow-Credentials', 'true'); // If using authentication

        return $response;
    }
}
