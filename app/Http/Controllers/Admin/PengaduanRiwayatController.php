<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanRiwayatController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::where('status', 'selesai')->orWhere('status', 'tolak')->get();

        return view('admin.pengaduan.selesai', compact('pengaduans'));
    }
}
