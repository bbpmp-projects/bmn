<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'nama_lengkap',
        'unit_kerja',
        'nip',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the user's full name.
     * Jika nama_lengkap kosong, gunakan username
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->nama_lengkap ?? $this->username;
    }

    /**
     * Get the user's unit kerja.
     * Jika unit_kerja kosong, return default
     *
     * @return string
     */
    public function getUnitAttribute()
    {
        return $this->unit_kerja ?? 'Belum ditentukan';
    }

    /**
     * Scope untuk filter berdasarkan unit kerja
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $unitKerja
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUnitKerja($query, $unitKerja)
    {
        return $query->where('unit_kerja', 'like', '%' . $unitKerja . '%');
    }

    /**
     * Scope untuk filter berdasarkan NIP
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $nip
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByNip($query, $nip)
    {
        return $query->where('nip', $nip);
    }

    /**
     * Scope untuk search user berdasarkan nama atau username
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function($q) use ($keyword) {
            $q->where('username', 'like', '%' . $keyword . '%')
              ->orWhere('nama_lengkap', 'like', '%' . $keyword . '%')
              ->orWhere('email', 'like', '%' . $keyword . '%')
              ->orWhere('nip', 'like', '%' . $keyword . '%');
        });
    }

    /**
     * Relasi ke tabel permintaan (jika ada)
     * Uncomment jika sudah membuat model Permintaan
     */
    // public function permintaan()
    // {
    //     return $this->hasMany(Permintaan::class, 'user_id', 'id');
    // }

    /**
     * Check if user has NIP
     *
     * @return bool
     */
    public function hasNip()
    {
        return !empty($this->nip);
    }

    /**
     * Get formatted NIP
     *
     * @return string
     */
    public function getFormattedNipAttribute()
    {
        if (empty($this->nip)) {
            return '-';
        }
        return $this->nip;
    }

    /**
     * Get user initials
     *
     * @return string
     */
    public function getInitialsAttribute()
    {
        $nama = $this->nama_lengkap ?? $this->username;
        $words = explode(' ', $nama);
        
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        
        return strtoupper(substr($nama, 0, 2));
    }
}