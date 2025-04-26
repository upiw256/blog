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

        // Ambil Origin dari request header
        $origin = $request->headers->get('Origin');

        // Cek apakah Origin ada dan dari domain yang diizinkan
        $allowedOrigins = [
            'https://lulus.sman1margaasih.sch.id',
            'http://192.168.18.22', // tambahkan jika perlu
        ];

        // Set header CORS hanya jika origin valid
        if (in_array($origin, $allowedOrigins)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
        } else {
            $response->headers->set('Access-Control-Allow-Origin', '*'); // Kalau tidak valid, gunakan * (atau bisa kosong)
        }

        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');  // Jika menggunakan autentikasi

        return $response;
    }
}
