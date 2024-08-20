<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostinganController extends Controller
{
    public function show($id)
    {
        $pengaduan = Pengaduan::where('id', $id)->first();
        return view('pengguna.postingan.show', compact('pengaduan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'komentar' => 'required',
        ], [
            'komentar.required' => 'Komentar harus diisi!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Komentar!');
            return back()->withInput()->withErrors($validator);
        }

        Komentar::create([
            'pengaduan_id' => $request->pengaduan_id,
            'user_id' => auth()->user()->id,
            'komentar' => $request->komentar,
        ]);

        alert()->success('Success', 'Berhasil menambahkan Komentar');
        return back();
    }
}
