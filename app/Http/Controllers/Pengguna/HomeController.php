<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::where([
            ['status', '!=', 'menunggu'],
            ['status', '!=', 'tolak']
        ])->get();

        return view('pengguna.index', compact('pengaduans'));
    }
}
