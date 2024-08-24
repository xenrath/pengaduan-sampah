<?php

namespace App\Http\Controllers\Pengguna;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gambar;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengguna.pengaduan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alamat' => 'required',
            'patokan' => 'required',
            'latitude' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required|max:2048',
        ], [
            'alamat.required' => 'Alamat harus diisi!',
            'patokan.required' => 'Patokan harus diisi!',
            'latitude.required' => 'Titik Lokasi harus ditambahkan!',
            'keterangan.required' => 'Keterangan harus diisi!',
            'gambar.required' => 'Gambar harus ditambahkan!',
            // 'gambar.image' => 'Gambar yang dimasukan salah!'
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal membuat Pengaduan!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $pengaduan = Pengaduan::create(array_merge($request->all(), [
            'user_id' => auth()->user()->id,
            'patokan' => $request->patokan,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tanggal_buat' => Carbon::now(),
            'status' => 'menunggu',
        ]));

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

        $user = User::where('id', $pengaduan->user_id)->first();
        $message = $user->nama . ' ' . "membuat pengaduan baru"  . PHP_EOL;
        $telp = User::where('role', 'admin')->value('telp');

        $this->kirim($telp, $message);

        alert()->success('Success', 'Berhasil membuat Pengaduan');

        return redirect('pengguna/list-pengaduan');
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