<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $pengaduan_menunggu = Pengaduan::where('status', 'konfirmasi')->count();
        $pengaduan_proses = Pengaduan::where('status', 'proses')->count();
        $pengaduan_selesai = Pengaduan::where('status', 'selesai')->count();

        return view('petugas.index', compact(
            'pengaduan_menunggu',
            'pengaduan_proses',
            'pengaduan_selesai'
        ));
    }
}
