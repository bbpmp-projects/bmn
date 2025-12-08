<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = 'kode_permintaan';
    public $incrementing = true; // Karena INT auto-increment
    protected $keyType = 'int'; // Tipe data integer
    
    protected $fillable = [
        // 'kode_permintaan' tidak perlu diisi karena auto-increment
        'id_users',
        'tanggal',
        'total_barang',
        'status'
    ];
    
    protected $casts = [
        'tanggal' => 'date',
        'kode_permintaan' => 'integer' // Pastikan casting ke integer
    ];
    
    // Accessor untuk mendapatkan kode referensi yang user-friendly
    public function getKodeReferensiAttribute()
    {
        $date = $this->tanggal ?: $this->created_at;
        return 'PR-' . $date->format('Ym') . '-' . str_pad($this->kode_permintaan, 4, '0', STR_PAD_LEFT);
    }
    
    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }
    
    public function detailPermintaan()
    {
        return $this->hasMany(DetailPermintaan::class, 'kode_permintaan', 'kode_permintaan');
    }
    
    // Accessor untuk mendapatkan nama pemohon dari relasi user
    public function getNamaPemohonAttribute()
    {
        return $this->user ? ($this->user->nama_lengkap ?? $this->user->username) : '-';
    }
    
    // Accessor untuk mendapatkan unit kerja dari relasi user
    public function getUnitKerjaAttribute()
    {
        return $this->user ? $this->user->unit_kerja : '-';
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
}