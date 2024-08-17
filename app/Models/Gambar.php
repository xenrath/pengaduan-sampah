<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;
    protected $fillable = [
        'pengaduan_id',
        'gambar',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

}