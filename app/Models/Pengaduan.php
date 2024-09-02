<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'petugas_id',
        'user_id',
        'keterangan',
        'alasan',
        'alamat',
        'patokan',
        'latitude',
        'longitude',
        'tanggal_buat',
        'tanggal_proses',
        'tanggal_selesai',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function petugas()
    {
        return $this->belongsTo(User::class);
    }

    public function gambar()
    {
        return $this->hasMany(Gambar::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }
}