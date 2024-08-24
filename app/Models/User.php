<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'nik',
        'telp',
        'verifikasi',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function isAdmin()
    {
        if ($this->role == 'admin') {
            return true;
        } else {
            return false;
        }
    }
    
    public function isPetugas()
    {
        if ($this->role == 'petugas') {
            return true;
        } else {
            return false;
        }
    }
    
    public function isPengguna()
    {
        if ($this->role == 'pengguna') {
            return true;
        } else {
            return false;
        }
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
    }
}