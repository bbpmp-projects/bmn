<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profile
     */
    public function index()
    {
        $user = DB::table('users')
            ->where('id', session('user_id'))
            ->first();

        // Generate inisial dari nama lengkap
        $user->initial = $this->getInitial($user->nama_lengkap);

        return view('profile.index', compact('user'));
    }

    /**
     * Generate inisial dari nama lengkap
     * Contoh: "Ahmad Budi" => "AB", "Siti Maemunah" => "SM"
     */
    private function getInitial($nama_lengkap)
    {
        // Bersihkan nama dari spasi berlebih
        $nama_lengkap = trim($nama_lengkap);
        
        // Pisahkan kata-kata
        $words = preg_split('/\s+/', $nama_lengkap);
        
        if (count($words) >= 2) {
            // Ambil huruf pertama dari kata pertama dan kedua
            $initial = strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8') . 
                mb_substr($words[1], 0, 1, 'UTF-8')
            );
        } else {
            // Jika hanya satu kata, ambil dua huruf pertama
            $initial = strtoupper(mb_substr($words[0], 0, 2, 'UTF-8'));
        }
        
        return $initial;
    }

    /**
     * Update profile user
     */
    public function update(Request $request)
    {
        $user = DB::table('users')
            ->where('id', session('user_id'))
            ->first();

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:100|unique:users,username,' . $user->id,
            'nip' => 'nullable|string|max:50|unique:users,nip,' . $user->id,
            'unit_kerja' => 'required|string|max:100',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'unit_kerja.required' => 'Unit kerja wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'nama_lengkap' => $request->nama_lengkap,
                    'email' => $request->email,
                    'username' => $request->username,
                    'nip' => $request->nip,
                    'unit_kerja' => $request->unit_kerja,
                    'no_telepon' => $request->no_telepon,
                    'alamat' => $request->alamat,
                    'updated_at' => now(),
                ]);

            // Update session
            $request->session()->put('user_name', $request->nama_lengkap);
            $request->session()->put('user_email', $request->email);
            $request->session()->put('user_unit_kerja', $request->unit_kerja);
            $request->session()->put('user_nip', $request->nip);

            Log::info('Profile updated', ['user_id' => $user->id]);

            // Generate inisial baru untuk response
            $initial = $this->getInitial($request->nama_lengkap);

            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil diperbarui!',
                'initial' => $initial,
                'nama_lengkap' => $request->nama_lengkap,
                'user' => [
                    'name' => $request->nama_lengkap,
                    'email' => $request->email,
                    'unit_kerja' => $request->unit_kerja
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui profile.'
            ], 500);
        }
    }

    /**
     * Update password user
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password baru minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = DB::table('users')
            ->where('id', session('user_id'))
            ->first();

        // Cek password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password saat ini salah'
            ], 400);
        }

        try {
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'password' => Hash::make($request->new_password),
                    'updated_at' => now(),
                ]);

            Log::info('Password updated', ['user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diubah!'
            ]);

        } catch (\Exception $e) {
            Log::error('Password update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah password.'
            ], 500);
        }
    }

    /**
     * Get initial untuk API (optional)
     */
    public function getInitialApi()
    {
        $user = DB::table('users')
            ->where('id', session('user_id'))
            ->first();

        $initial = $this->getInitial($user->nama_lengkap);

        return response()->json([
            'success' => true,
            'initial' => $initial,
            'nama_lengkap' => $user->nama_lengkap
        ]);
    }
}