<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    public function index()
    {
        $penggunas = User::where('role', 'pengguna')->get();

        return view('admin.pengguna.index', compact('penggunas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nik' => 'required|unique:users,nik',
            'telp' => 'required|unique:users,telp',
        ], [
            'nama.required' => 'Nama Petugas harus diisi!',
            'nik.required' => 'NIK harus diisi!',
            'nik.unique' => 'NIK sudah digunakan!',
            'telp.required' => 'Nomor Telepon harus diisi!',
            'telp.unique' => 'Nomor Telepon sudah digunakan!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        User::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'telp' => $request->telp,
            'password' => bcrypt('pengguna'),
            'role' => 'pengguna',
        ]);

        alert()->success('Success', 'Berhasil menambahkan Petugas');
        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nik' => 'required|unique:users,nik,' . $id,
            'telp' => 'required|unique:users,telp,' . $id,
        ], [
            'nama.required' => 'Nama Petugas harus diisi!',
            'nik.required' => 'NIK harus diisi!',
            'nik.unique' => 'NIK sudah digunakan!',
            'telp.required' => 'Nomor Telepon harus diisi!',
            'telp.unique' => 'Nomor Telepon sudah digunakan!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        User::where('id', $id)->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'telp' => $request->telp,
            'role' => 'pengguna',
        ]);

        alert()->success('Success', 'Berhasil memperbarui Petugas');
        return back();
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        alert()->success('Success', 'Berhasil menghapus Petugas');
        return back();
    }

    public function reset($id)
    {
        User::where('id', $id)->update([
            'password' => bcrypt('pengguna')
        ]);

        alert()->success('Success', 'Berhasil mereset Password');
        return back();
    }
}
