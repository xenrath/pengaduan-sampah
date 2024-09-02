<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaduanMenungguController extends Controller
{
    public function index()
    {
        $petugass = User::where('role', 'petugas')->get();
        $pengaduans = Pengaduan::where('status', 'menunggu')->get();

        return view('admin.pengaduan.menunggu', compact('pengaduans', 'petugass'));
    }

    public function tolak($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alasan' => 'required',
        ], [
            'alasan.required' => 'Masukkan keterangan',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Pengaduan::where('id', $id)->update([
            'status' => 'tolak',
            'alasan' => $request->alasan
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $message = "Pengaduan anda di tolak"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Keterangan : " . $pengaduan->alasan . PHP_EOL;

        $telp = User::where('id', $pengaduan->user_id)->value('telp');

        $this->kirim($telp, $message);

        alert()->success('Success', 'Berhasil menolak Pengaduan');
        return back();
    }

    public function konfirmasi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'petugas_id' => 'required',
        ], [
            'petugas_id.required' => 'Pilih petugas',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        $pengaduan = Pengaduan::where('id', $id)->update([
            'petugas_id' => $request->petugas_id,
            'status' => 'konfirmasi'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $message = "Admin telah mengkonfirmasi pengaduan baru"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Keterangan : " . $pengaduan->keterangan . PHP_EOL;
        $message .= "Mohon segera di proses" . PHP_EOL;

        $telp = User::where('role', 'petugas')->value('telp');

        $this->kirim($telp, $message);

        alert()->success('Success', 'Berhasil mengonfirmasi Pengaduan');
        return back();
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
