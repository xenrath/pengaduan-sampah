<?php

namespace App\Http\Controllers\Pengguna;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gambar;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengguna.pengaduan.create');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'alamat' => 'required',
                'latitude' => 'required',
            ],
            [
                'alamat.required' => 'Masukkan alamat',
                'latitude.required' => 'Pilih titik lokasi',
            ]
        );

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        $pengaduan = Pengaduan::create(array_merge(
            $request->all(),
            [
                'user_id' => auth()->user()->id,
                'patokan' => $request->patokan,
                'alamat' => $request->alamat,
                'keterangan' => $request->keterangan,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ],
        ));

        if ($request->has('gambar')) {
            $gambars = $request->file('gambar');

            foreach ($gambars as $gambar) {
                $name = str_replace(' ', '', $gambar->getClientOriginalName());
                $namagambar = 'gambar/' . date('mYdHs') . random_int(1, 10) . '_' . $name;
                $gambar->storeAs('public/uploads', $namagambar);

                Gambar::create([
                    'pengaduan_id' => $pengaduan->id,
                    'gambar' => $namagambar
                ]);
            }
        }

        return redirect('pengguna/pengaduan')->with('success', 'Berhasil menambahkan');
    }

}