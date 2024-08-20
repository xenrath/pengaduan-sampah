<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gambar;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Validator;

class PengaduanselesaiController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::where('status', 'selesai')->get();
        return view('petugas.selesai.index', compact('pengaduans'));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::where('id', $id)->first();
        $gambars = Gambar::where('pengaduan_id', $pengaduan->id)->get();
        return view('petugas.selesai.show', compact('pengaduan', 'gambars'));
    }
}