<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $pengaduan_menunggu = Pengaduan::where('status', 'menunggu')->count();
        $pengaduan_proses = Pengaduan::where('status', 'konfirmasi')->orWhere('status', 'proses')->count();
        $pengaduan_selesai = Pengaduan::where('status', 'selesai')->count();
        $petugas = User::where('role', 'petugas')->count();
        $pengguna = User::where('role', 'pengguna')->count();

        return view('admin.index', compact(
            'pengaduan_menunggu',
            'pengaduan_proses',
            'pengaduan_selesai',
            'petugas',
            'pengguna',
        ));
    }
}
