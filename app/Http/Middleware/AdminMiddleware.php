<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Hanya mengizinkan akses untuk admin
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan adalah admin
        if (!$request->session()->get('logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        if (!$request->session()->get('is_admin')) {
            // Untuk AJAX/JSON requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'requires_admin' => true,
                    'message' => 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.',
                    'redirect' => route('home'),
                    'alert' => [
                        'type' => 'error',
                        'title' => 'Akses Ditolak'
                    ]
                ], 403);
            }
            
            return redirect()->route('home')->with([
                'error' => 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.'
            ]);
        }

        return $next($request);
    }
}