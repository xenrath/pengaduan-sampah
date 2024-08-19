<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gambar;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Validator;

class PengaduanmenungguController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::where('status', 'menunggu')->get();
        return view('petugas.menunggu.index', compact('pengaduans'));
    }


    public function proses_pengaduan(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'tanggal_proses' => 'required',
            ],
            [
                'tanggal_proses.required' => 'Pilih Tanggal',
            ]
        );

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'tanggal_proses' => $request->tanggal_proses,
            'status' => 'proses',
        ]);

        return redirect()->back()->with('success', 'Berhasil mengubah status');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::where('id', $id)->first();
        $gambars = Gambar::where('pengaduan_id', $pengaduan->id)->get();
        return view('petugas.menunggu.show', compact('pengaduan', 'gambars'));
    }
}