<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     * Redirect jika user BELUM login
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->get('logged_in')) {
            
            // Untuk AJAX/JSON requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'requires_login' => true,
                    'message' => 'Anda harus login terlebih dahulu sebelum mengakses fitur tersebut.',
                    'redirect' => route('login'),
                    'alert' => [
                        'type' => 'warning',
                        'title' => 'Akses Dibatasi'
                    ]
                ], 401);
            }
            
            // Untuk form submissions
            if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('delete')) {
                return back()->with('auth_error', 'Anda harus login terlebih dahulu sebelum mengakses fitur tersebut.');
            }
            
            // Untuk GET requests biasa
            $request->session()->put('intended_url', $request->fullUrl());
            
            return redirect()->route('login')->with([
                'auth_alert' => [
                    'type' => 'warning',
                    'title' => 'Akses Dibatasi',
                    'message' => 'Anda harus login terlebih dahulu sebelum mengakses fitur tersebut.'
                ],
                'error' => 'Silakan login terlebih dahulu'
            ]);
        }

        return $next($request);
    }
}
