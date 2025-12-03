<?php
// app/Http/Middleware/RedirectIfAuthenticated.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     * Redirect jika user SUDAH login (untuk halaman login/register)
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if ($request->session()->get('logged_in')) {
            // Redirect ke home jika sudah login
            return redirect('/')->with('info', 'Anda sudah login');
        }

        return $next($request);
    }
}