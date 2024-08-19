<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanSelesaiController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::where('status', 'selesai')->get();

        return view('admin.pengaduan.selesai', compact('pengaduans'));
    }
}
