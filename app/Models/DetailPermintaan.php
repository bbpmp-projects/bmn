<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPermintaan extends Model
{
    protected $table = 'detail_permintaan';
    protected $primaryKey = 'id_detail_permintaan';
    
    protected $fillable = [
        'kode_permintaan', // integer
        'kode_barang', // string/varchar
        'jumlah'
    ];
    
    // Casting untuk memastikan tipe data
    protected $casts = [
        'kode_permintaan' => 'integer'
    ];
    
    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class, 'kode_permintaan', 'kode_permintaan');
    }
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}