<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gambar;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Validator;

class PengaduandiprosesController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::where('status', 'proses')->get();
        return view('petugas.diproses.index', compact('pengaduans'));
    }

    public function selesai_pengaduan(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ],
            [
                'foto.required' => 'Foto tidak boleh kosong',
                'foto.image' => 'Foto yang dimasukan salah!',
            ]
        );

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        if ($request->foto) {
            $gambar = str_replace(' ', '', $request->foto->getClientOriginalName());
            $namaGambar = 'proses/' . date('mYdHs') . rand(1, 10) . '_' . $gambar;
            $request->foto->storeAs('public/uploads/', $namaGambar);
        } else {
            $namaGambar = null;
        }

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'status' => 'selesai',
            'foto' => $namaGambar,

        ]);

        return redirect()->back()->with('success', 'Pengaduan Selesai');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::where('id', $id)->first();
        $gambars = Gambar::where('pengaduan_id', $pengaduan->id)->get();
        return view('petugas.diproses.show', compact('pengaduan', 'gambars'));
    }
}