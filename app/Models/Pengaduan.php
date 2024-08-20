<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'keterangan',
        'alamat',
        'patokan',
        'tanggal_proses',
        'foto',
        'status',
        'latitude',
        'longitude',
    ];

    public function user()
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