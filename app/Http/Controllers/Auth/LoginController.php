<?php
// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Log request untuk debugging
        Log::info('Login attempt', [
            'login' => $request->login,
            'ip' => $request->ip()
        ]);

        // Validation
        $validator = \Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string'
        ], [
            'login.required' => 'Username atau email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // **PRIORITAS 1: Cari di tabel admins terlebih dahulu**
            $admin = DB::table('admins')
                ->where(function($query) use ($request) {
                    $query->where('username', $request->login)
                          ->orWhere('email', $request->login);
                })
                ->first();

            // **PRIORITAS 2: Jika bukan admin, cari di users**
            $user = null;
            if (!$admin) {
                $user = DB::table('users')
                    ->where(function($query) use ($request) {
                        $query->where('username', $request->login)
                              ->orWhere('email', $request->login);
                    })
                    ->first();
            }

            Log::info('Login search result', [
                'login_input' => $request->login,
                'admin_found' => $admin ? 'yes' : 'no',
                'user_found' => $user ? 'yes' : 'no',
                'admin_id' => $admin ? $admin->id : null,
                'user_id' => $user ? $user->id : null
            ]);

            // **CASE 1: Admin login**
            if ($admin && Hash::check($request->password, $admin->password)) {
                Log::info('Admin login successful', ['admin_id' => $admin->id]);
                
                // Set session untuk admin
                $request->session()->put('user_id', $admin->id);
                $request->session()->put('user_name', $admin->nama_lengkap);
                $request->session()->put('user_email', $admin->email);
                $request->session()->put('user_nip', $admin->nip);
                $request->session()->put('logged_in', true);
                $request->session()->put('is_admin', true);
                $request->session()->put('admin_id', $admin->id);
                
                // Tambahkan unit_kerja jika ada di tabel admins
                if (isset($admin->unit_kerja)) {
                    $request->session()->put('user_unit_kerja', $admin->unit_kerja);
                }

                // Regenerate session untuk keamanan
                $request->session()->regenerate();

                // Update last login time di tabel admins
                DB::table('admins')
                    ->where('id', $admin->id)
                    ->update(['updated_at' => now()]);

                $redirectUrl = route('admin.dashboard');
                
                Log::info('Redirecting admin to', ['url' => $redirectUrl]);

                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil! Selamat datang ' . $admin->nama_lengkap,
                    'redirect' => $redirectUrl,
                    'is_admin' => true,
                    'user' => [
                        'name' => $admin->nama_lengkap,
                        'email' => $admin->email,
                        'role' => 'admin'
                    ]
                ], 200);
            }
            
            // **CASE 2: User biasa login**
            if ($user && Hash::check($request->password, $user->password)) {
                Log::info('User login successful', ['user_id' => $user->id]);
                
                // Set session untuk user biasa
                $request->session()->put('user_id', $user->id);
                $request->session()->put('user_name', $user->nama_lengkap);
                $request->session()->put('user_email', $user->email);
                $request->session()->put('user_unit_kerja', $user->unit_kerja);
                $request->session()->put('user_nip', $user->nip);
                $request->session()->put('logged_in', true);
                $request->session()->put('is_admin', false); // Pastikan false

                // Regenerate session untuk keamanan
                $request->session()->regenerate();

                // Update last login time
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['updated_at' => now()]);

                $redirectUrl = url('/');
                
                Log::info('Redirecting user to', ['url' => $redirectUrl]);

                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil! Selamat datang ' . $user->nama_lengkap,
                    'redirect' => $redirectUrl,
                    'is_admin' => false,
                    'user' => [
                        'name' => $user->nama_lengkap,
                        'email' => $user->email,
                        'role' => 'user'
                    ]
                ], 200);
            }

            // **CASE 3: Login gagal**
            Log::warning('Login failed - Invalid credentials', [
                'login_input' => $request->login,
                'admin_exists' => $admin ? 'yes' : 'no',
                'user_exists' => $user ? 'yes' : 'no',
                'password_check_admin' => $admin ? Hash::check($request->password, $admin->password) : 'n/a',
                'password_check_user' => $user ? Hash::check($request->password, $user->password) : 'n/a'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Username/Email atau password salah!'
            ], 401);

        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        // Clear session
        $request->session()->forget([
            'user_id', 
            'user_name', 
            'user_email', 
            'user_unit_kerja', 
            'user_nip', 
            'logged_in',
            'is_admin',
            'admin_id'
        ]);

        // Flush all session data
        $request->session()->flush();

        // Regenerate session ID for security
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Logout berhasil!');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password request
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Check if email exists di users atau admins
        $user = DB::table('users')->where('email', $request->email)->first();
        if (!$user) {
            $user = DB::table('admins')->where('email', $request->email)->first();
        }

        if ($user) {
            // TODO: Implement password reset logic (send email, etc.)
            Log::info('Password reset requested', ['email' => $request->email]);
            
            return response()->json([
                'success' => true,
                'message' => 'Link reset password telah dikirim ke email Anda.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email tidak ditemukan.'
        ], 404);
    }
}