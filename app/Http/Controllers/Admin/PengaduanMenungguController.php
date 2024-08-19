<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
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

        alert()->success('Success', 'Berhasil mengonfirmasi Pengaduan');
        return back();
    }

    public function konfirmasi($id)
    {
        Pengaduan::where('id', $id)->update([
            'status' => 'konfirmasi'
        ]);

        alert()->success('Success', 'Berhasil mengonfirmasi Pengaduan');
        return back();
    }
}
