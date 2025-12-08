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
     * Get user ID dari session
     */
    private function getUserId()
    {
        // Ambil dari session yang di-set saat login
        return session('user_id') ?? session('id');
    }

    /**
     * Menampilkan halaman profile
     */
    public function index()
    {
        try {
            $userId = $this->getUserId();
            
            if (!$userId) {
                Log::warning('Profile index: No user ID in session');
                return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
            }

            $user = DB::table('users')
                ->where('id', $userId)
                ->first();

            if (!$user) {
                Log::warning('Profile index: User not found', ['user_id' => $userId]);
                return redirect()->route('login')->with('error', 'User tidak ditemukan');
            }

            // Generate inisial dari nama lengkap
            $user->initial = $this->getInitial($user->nama_lengkap);

            return view('profile.index', compact('user'));
        } catch (\Exception $e) {
            Log::error('Profile index error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->route('home')->with('error', 'Terjadi kesalahan saat memuat profile');
        }
    }

    /**
     * Generate inisial dari nama lengkap
     */
    private function getInitial($nama_lengkap)
    {
        try {
            $nama_lengkap = trim($nama_lengkap);
            $words = preg_split('/\s+/', $nama_lengkap);
            
            if (count($words) >= 2) {
                $initial = strtoupper(
                    mb_substr($words[0], 0, 1, 'UTF-8') . 
                    mb_substr($words[1], 0, 1, 'UTF-8')
                );
            } else {
                $initial = strtoupper(mb_substr($words[0], 0, 2, 'UTF-8'));
            }
            
            return $initial;
        } catch (\Exception $e) {
            Log::error('Get initial error: ' . $e->getMessage());
            return 'NA';
        }
    }

    /**
     * Update profile user
     */
    public function update(Request $request)
    {
        try {
            $userId = $this->getUserId();
            
            // Log untuk debugging
            Log::info('Profile update attempt', [
                'session_all' => session()->all(),
                'user_id' => $userId,
                'request_data' => $request->except(['_token', 'password'])
            ]);

            if (!$userId) {
                Log::warning('Profile update: No user ID in session');
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Silakan login kembali.',
                    'requires_login' => true
                ], 401);
            }

            $user = DB::table('users')
                ->where('id', $userId)
                ->first();

            if (!$user) {
                Log::warning('Profile update: User not found', ['user_id' => $userId]);
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan.'
                ], 404);
            }

            // Validasi
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'username' => 'required|string|max:100|unique:users,username,' . $user->id,
                'nip' => 'nullable|string|max:50|unique:users,nip,' . $user->id,
                'unit_kerja' => 'required|string|max:100',
            ], [
                'nama_lengkap.required' => 'Nama lengkap wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.unique' => 'Email sudah digunakan',
                'username.required' => 'Username wajib diisi',
                'username.unique' => 'Username sudah digunakan',
                'nip.unique' => 'NIP sudah digunakan',
                'unit_kerja.required' => 'Unit kerja wajib diisi',
            ]);

            if ($validator->fails()) {
                Log::info('Profile update validation failed', [
                    'errors' => $validator->errors()->toArray()
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Update user
            $updated = DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'nama_lengkap' => $request->nama_lengkap,
                    'email' => $request->email,
                    'username' => $request->username,
                    'nip' => $request->nip,
                    'unit_kerja' => $request->unit_kerja,
                    'updated_at' => now(),
                ]);

            if (!$updated) {
                Log::warning('Profile update: No rows affected', ['user_id' => $user->id]);
            }

            // Update session dengan data terbaru
            session([
                'user_name' => $request->nama_lengkap,
                'user_email' => $request->email,
                'user_username' => $request->username,
                'user_unit_kerja' => $request->unit_kerja,
                'user_nip' => $request->nip,
            ]);

            Log::info('Profile updated successfully', ['user_id' => $user->id]);

            // Generate inisial baru
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
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Request data: ' . json_encode($request->except(['_token', 'password'])));

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui profile: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update password user
     */
    public function updatePassword(Request $request)
    {
        try {
            $userId = $this->getUserId();

            Log::info('Password update attempt', [
                'user_id' => $userId
            ]);

            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Silakan login kembali.',
                    'requires_login' => true
                ], 401);
            }

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
                ->where('id', $userId)
                ->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan.'
                ], 404);
            }

            // Cek password saat ini
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password saat ini salah'
                ], 400);
            }

            // Update password
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'password' => Hash::make($request->new_password),
                    'updated_at' => now(),
                ]);

            Log::info('Password updated successfully', ['user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diubah!'
            ]);

        } catch (\Exception $e) {
            Log::error('Password update error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah password: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get initial untuk API (optional)
     */
    public function getInitialApi()
    {
        try {
            $userId = $this->getUserId();

            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired'
                ], 401);
            }

            $user = DB::table('users')
                ->where('id', $userId)
                ->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ], 404);
            }

            $initial = $this->getInitial($user->nama_lengkap);

            return response()->json([
                'success' => true,
                'initial' => $initial,
                'nama_lengkap' => $user->nama_lengkap
            ]);
        } catch (\Exception $e) {
            Log::error('Get initial API error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan'
            ], 500);
        }
    }
}