<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;

class PengaduanMenungguController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::where('status', 'menunggu')->get();

        return view('admin.pengaduan.menunggu', compact('pengaduans'));
    }

    public function tolak($id)
    {
        Pengaduan::where('id', $id)->update([
            'status' => 'tolak'
        ]);

        alert()->success('Success', 'Berhasil menolak Pengaduan');
        return back();
    }

    public function konfirmasi($id)
    {
        $pengaduan = Pengaduan::where('id', $id)->update([
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