<?php

namespace App\Http\Controllers\Pengguna;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::all();
        return view('pengguna.pengaduan.index', compact('pengaduans'));
    }

    public function create()
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
                'alamat.required' => 'Masukkan tujuan muat',
                'latitude.required' => 'Pilih titik tujuan',
            ]
        );

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        $kode = $this->kode();

        Pengaduan::create(array_merge(
            $request->all(),
            [
                'kode_alamat' => $this->kode(),
                'tanggal_awal' => Carbon::now('Asia/Jakarta'),
                'pelanggan_id' => $request->pelanggan_id,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ],
        ));

        return redirect('pengguna/pengaduan')->with('success', 'Berhasil menambahkan tujuan muat');
    }

}