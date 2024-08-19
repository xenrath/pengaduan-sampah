<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanProsesController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::where('status', 'konfirmasi')->orWhere('status', 'proses')->get();
        
        return view('admin.pengaduan.proses', compact('pengaduans'));
    }
}
