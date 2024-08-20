<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gambar;
use App\Models\Pengaduan;
use App\Models\User;
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

        $pengaduan = Pengaduan::findOrFail($id);

        $message = "Pengaduan anda telah di selesaikan oleh petugas"  . PHP_EOL;

        $telp = User::where('id', $pengaduan->user_id)->value('telp');

        $this->kirim($telp, $message);

        return redirect()->back()->with('success', 'Pengaduan Selesai');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::where('id', $id)->first();
        $gambars = Gambar::where('pengaduan_id', $pengaduan->id)->get();
        return view('petugas.diproses.show', compact('pengaduan', 'gambars'));
    }

    public function kirim($telp, $message)
    {
        $data = [
            'target' => $telp,
            'message' => $message
        ];

        $curl = curl_init();
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: bW4ZATiVth1!kKzeqbvH",
            )
        );

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = json_decode(curl_exec($curl));

        return $result;
    }
}