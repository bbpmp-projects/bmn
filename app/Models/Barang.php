<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang'; // Sesuaikan dengan nama primary key di tabel
    protected $fillable = ['kode_barang', 'nama_barang', 'satuan', 'id_kategori', 'stok'];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}