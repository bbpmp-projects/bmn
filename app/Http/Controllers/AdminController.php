<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
=======
>>>>>>> e9ebf2e08163f7bdafeadb8ea2fdc815a2b6c61d

class AdminController extends Controller
{
    // Method untuk menampilkan dashboard admin
<<<<<<< HEAD
    public function dashboard(Request $request)
    {
        // Middleware sudah menangani pengecekan admin
        
        // Ambil data admin dari session
        $adminData = [
            'name' => $request->session()->get('user_name'),
            'email' => $request->session()->get('user_email'),
            'nip' => $request->session()->get('user_nip'),
            'unit_kerja' => $request->session()->get('user_unit_kerja')
        ];
        
        // Ambil statistik untuk dashboard admin
        $stats = [
            'total_users' => DB::table('users')->count(),
            'total_admins' => DB::table('admins')->count(),
            'total_permintaan' => DB::table('permintaan')->count(),
            'permintaan_pending' => DB::table('permintaan')->where('status', 'pending')->count(),
            'permintaan_disetujui' => DB::table('permintaan')->where('status', 'approved')->count(),
            'permintaan_ditolak' => DB::table('permintaan')->where('status', 'rejected')->count(),
        ];
        
        // Tambahkan data statistik atau data lainnya yang diperlukan
        return view('admin.dashboard', compact('adminData', 'stats'));
    }

     public function showAdminRegister()
    {
        return view('admin.register-public');
    }
    
    /**
     * Handle register admin (PUBLIC - tidak perlu login)
     */
    public function storeAdmin(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:admins,username',
            'email' => 'required|email|unique:admins,email',
            'nip' => 'required|unique:admins,nip',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ], [
            'username.unique' => 'Username sudah digunakan',
            'email.unique' => 'Email sudah digunakan',
            'nip.unique' => 'NIP sudah terdaftar',
            'password_confirmation.same' => 'Password tidak cocok'
        ]);
        
        try {
            // Insert langsung ke tabel admins
            DB::table('admins')->insert([
                'nama_lengkap' => $request->nama_lengkap,
                'username' => $request->username,
                'email' => $request->email,
                'nip' => $request->nip,
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            return back()->with('success', '✅ Admin berhasil didaftarkan! Data sudah masuk ke database.');
            
        } catch (\Exception $e) {
            return back()->with('error', '❌ Gagal: ' . $e->getMessage())->withInput();
        }
    }
    
  
}
=======
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
>>>>>>> e9ebf2e08163f7bdafeadb8ea2fdc815a2b6c61d
