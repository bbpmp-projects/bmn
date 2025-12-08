<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\User;
use App\Models\Permintaan;
use App\Models\DetailPermintaan;
use Carbon\Carbon;

class PermintaanController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all();

        $userId = $request->session()->get('user_id');
        $user   = User::find($userId);

        return view('permintaan.permintaan', compact('kategori', 'user'));
    }

    // API untuk mendapatkan barang berdasarkan kategori
    public function getBarangByKategori($id_kategori)
    {
        $barang = Barang::where('id_kategori', $id_kategori)->get();
        
        return response()->json([
            'success' => true,
            'data' => $barang
        ]);
    }
    
    // API untuk search barang
    public function searchBarang(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');
        
        $query = Barang::query();
        
        if ($kategori) {
            $query->where('id_kategori', $kategori);
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $search . '%');
            });
        }
        
        $barang = $query->get();
        
        return response()->json([
            'success' => true,
            'data' => $barang
        ]);
    }

    // API untuk mendapatkan data user yang sedang login
    public function getCurrentUser()
    {
        $user = Auth::user();
        
        return response()->json([
            'success' => true,
            'data' => [
                'username' => $user->username,
                'nama_lengkap' => $user->nama_lengkap,
                'unit_kerja' => $user->unit_kerja,
                'nip' => $user->nip,
                'email' => $user->email,
            ]
        ]);
    }

    // Submit permintaan baru - REVISI BESAR
    public function submitPermintaan(Request $request)
    {
        $request->validate([
            'tanggal_permintaan' => 'required|date',
            'barang' => 'required|array|min:1',
            'barang.*.kode' => 'required|string',
            'barang.*.jumlah' => 'required|integer|min:1'
        ]);

        try {
            DB::beginTransaction();

            // Simpan data permintaan - kode_permintaan akan auto-increment (INT)
            $userId = $request->session()->get('user_id');
            
            $permintaan = Permintaan::create([
                // 'kode_permintaan' TIDAK diisi, akan auto-increment sebagai INT
                'id_users' => $userId,
                'tanggal' => $request->tanggal_permintaan,
                'total_barang' => count($request->barang),
                'status' => 'pending'
            ]);

            // Simpan detail permintaan
            foreach ($request->barang as $item) {
                DetailPermintaan::create([
                    'kode_permintaan' => $permintaan->kode_permintaan, // ID integer dari permintaan
                    'kode_barang' => $item['kode'],
                    'jumlah' => $item['jumlah']
                ]);
            }

            DB::commit();

            // Generate kode referensi untuk ditampilkan ke user (format: PR-YYYYMM-XXXX)
            $kodeReferensi = 'PR-' . Carbon::parse($permintaan->tanggal)->format('Ym') . '-' . str_pad($permintaan->kode_permintaan, 4, '0', STR_PAD_LEFT);

            return response()->json([
                'success' => true,
                'message' => 'Permintaan berhasil disimpan!',
                'kode_permintaan' => $kodeReferensi, // Kirim kode referensi ke frontend
                'id_permintaan' => $permintaan->kode_permintaan // ID sebenarnya (integer)
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Method untuk menampilkan status permintaan 
    public function statusPermintaan(Request $request)
    {
        $userId = session()->get('user_id');
        
        $query = Permintaan::where('id_users', $userId)
            ->with(['detailPermintaan' => function($query) {
                $query->with('barang');
            }, 'user'])
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->has('filter_status') && $request->filter_status) {
            $query->where('status', $request->filter_status);
        }

        // Filter berdasarkan tanggal
        if ($request->has('filter_tanggal_dari') && $request->filter_tanggal_dari) {
            $query->whereDate('tanggal', '>=', $request->filter_tanggal_dari);
        }
        
        if ($request->has('filter_tanggal_sampai') && $request->filter_tanggal_sampai) {
            $query->whereDate('tanggal', '<=', $request->filter_tanggal_sampai);
        }

        $permintaan = $query->paginate(10);

        // Jika request AJAX, kembalikan JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $permintaan->items(),
                'current_page' => $permintaan->currentPage(),
                'last_page' => $permintaan->lastPage(),
                'total' => $permintaan->total(),
                'per_page' => $permintaan->perPage(),
                'from' => $permintaan->firstItem(),
                'to' => $permintaan->lastItem()
            ]);
        }

        return view('permintaan.status', compact('permintaan'));
    }

    // Method untuk melihat detail permintaan - REVISI
    public function detailPermintaan($kode_permintaan)
    {
        // Parameter $kode_permintaan bisa berupa string (PR-202512-0001) atau integer
        // Ekstrak ID integer jika format string
        if (strpos($kode_permintaan, 'PR-') === 0) {
            $parts = explode('-', $kode_permintaan);
            $id_permintaan = (int) end($parts); // Ambil bagian terakhir sebagai ID integer
        } else {
            $id_permintaan = (int) $kode_permintaan;
        }
        
        $permintaan = Permintaan::with(['detailPermintaan' => function($query) {
                $query->with('barang');
            }, 'user'])
            ->where('kode_permintaan', $id_permintaan)
            ->firstOrFail();
        
        return view('permintaan.detail', compact('permintaan'));
    }

    // Method untuk menampilkan riwayat permintaan - REVISI
    public function riwayatPermintaan()
    {
        $userId = session()->get('user_id');
        
        // Perbaiki: gunakan 'id_users' bukan 'user_id'
        $riwayat = Permintaan::where('id_users', $userId)
            ->with(['detailPermintaan', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('permintaan.riwayat', compact('riwayat'));
    }

    // NEW METHOD: API untuk mendapatkan data detail permintaan (untuk modal)
    public function getDetailPermintaan($id)
    {
        try {
            // Cari permintaan berdasarkan ID integer
            $permintaan = Permintaan::with(['detailPermintaan' => function($query) {
                $query->with('barang');
            }, 'user'])
            ->where('kode_permintaan', $id)
            ->firstOrFail();

            // Format data untuk response
            $data = [
                'kode_referensi' => 'PR-' . Carbon::parse($permintaan->tanggal)->format('Ym') . '-' . str_pad($permintaan->kode_permintaan, 4, '0', STR_PAD_LEFT),
                'tanggal' => $permintaan->tanggal,
                'tanggal_formatted' => Carbon::parse($permintaan->tanggal)->format('d/m/Y'),
                'status' => $permintaan->status,
                'nama_pemohon' => $permintaan->user->nama_lengkap ?? 'Tidak diketahui',
                'unit_kerja' => $permintaan->user->unit_kerja ?? 'Tidak diketahui',
                'detail_permintaan' => $permintaan->detailPermintaan->map(function($detail) {
                    return [
                        'kode_barang' => $detail->kode_barang,
                        'jumlah' => $detail->jumlah,
                        'barang' => $detail->barang ? [
                            'nama_barang' => $detail->barang->nama_barang,
                            'satuan' => $detail->barang->satuan
                        ] : null
                    ];
                })
            ];

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    // Di method daftarBarang() di PermintaanController.php
    public function daftarBarang(Request $request)
    {
        $kategori = Kategori::all();
        
        $query = Barang::with('kategori')
            ->orderBy('nama_barang', 'asc');

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori) {
            $query->where('id_kategori', $request->kategori);
        }

         // Filter berdasarkan status ketersediaan
        if ($request->has('status') && $request->status !== null && $request->status !== '') {
            if ($request->status === 'tersedia') {
                $query->where('stock', '>', 0);
            } elseif ($request->status === 'tidak_tersedia') {
                $query->where('stock', '<=', 0);
            }
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        $barang = $query->paginate(12);
        
        // Hitung statistik TOTAL dari database
        $totalBarang = Barang::count();
        $barangTersedia = Barang::where('stock', '>', 0)->count();
        $barangTidakTersedia = Barang::where('stock', '<=', 0)->count();

        // **PERUBAHAN DI SINI:**
        // Jika request AJAX atau ada parameter ajax=1, kembalikan JSON
        if ($request->ajax() || $request->has('ajax')) {
            return response()->json([
                'success' => true,
                'data' => $barang->items(),
                'current_page' => $barang->currentPage(),
                'last_page' => $barang->lastPage(),
                'total' => $barang->total(),
                'per_page' => $barang->perPage(),
                'from' => $barang->firstItem(),
                'to' => $barang->lastItem(),
                'statistics' => [
                    'total' => $totalBarang,
                    'tersedia' => $barangTersedia,
                    'tidak_tersedia' => $barangTidakTersedia
                ]
            ]);
        }

        // Untuk non-AJAX request, kirim semua data
        return view('barang.daftar', compact('barang', 'kategori', 'totalBarang', 'barangTersedia', 'barangTidakTersedia'));
    }

    // API untuk mendapatkan daftar barang
    public function getDaftarBarang(Request $request)
    {
        $query = Barang::with('kategori')
            ->orderBy('nama_barang', 'asc');

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori) {
            $query->where('id_kategori', $request->kategori);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        $barang = $query->get();

        return response()->json([
            'success' => true,
            'data' => $barang->map(function($item) {
                return [
                    'kode_barang' => $item->kode_barang,
                    'nama_barang' => $item->nama_barang,
                    'satuan' => $item->satuan,
                    'status' => $item->stock > 0 ? 'Tersedia' : 'Tidak Tersedia',
                    'kategori' => $item->kategori->nama_kategori ?? 'Tidak diketahui',
                    'warna_status' => $item->stock > 0 ? 'green' : 'red'
                ];
            })
        ]);
    }

}