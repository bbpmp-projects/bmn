<?php
// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validation
        $validator = \Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'nama_lengkap' => 'required|string|max:100',
            'unit_kerja' => 'required|string|max:100',
            'nip' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required'
        ], [
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'unit_kerja.required' => 'Unit kerja wajib diisi',
            'nip.required' => 'NIP wajib diisi',
            'nip.unique' => 'NIP sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sama',
            'terms.required' => 'Anda harus menyetujui syarat dan ketentuan'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Insert data ke database
            $userId = DB::table('users')->insertGetId([
                'username' => $request->username,
                'email' => $request->email,
                'nama_lengkap' => $request->nama_lengkap,
                'unit_kerja' => $request->unit_kerja,
                'nip' => $request->nip,
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil! Silakan login dengan akun Anda.',
                'redirect' => route('login')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }
}