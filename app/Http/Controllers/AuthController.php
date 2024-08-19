<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function register_proses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nik' => 'required|unique:users,nik',
            'telp' => 'required|unique:users,telp',
            'password' => 'required|confirmed'
        ], [
            'nama.required' => 'Nama Lengkap harus diisi!',
            'nik.required' => 'NIK harus diisi!',
            'nik.unique' => 'NIK sudah digunakan!',
            'telp.required' => 'Nomor Telepon harus diisi!',
            'telp.unique' => 'Nomor Telepon salah!',
            'password.required' => 'Password harus diisi!',
            'password.confirmed' => 'Konfirmasi Password tidak sesuai!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error!', 'Isi data dengan benar!');
            return back()->withInput()->withErrors($validator->errors());
        }

        User::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'telp' => $request->telp,
            'password' => bcrypt($request->password),
            'role' => 'pengguna'
        ]);

        alert()->success('Success', 'Berhasil melakukan Pendaftaran');

        return redirect('login');
    }

    public function login()
    {
        if (auth()->check()) {
            return redirect('/');
        } else {
            return view('login');
        }
    }

    public function login_proses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telp' => 'required',
            'password' => 'required',
        ], [
            'telp.required' => 'Nomor Telepon harus diisi!',
            'password.required' => 'Password harus diisi!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Isi data dengan benar!');
            return back()->withInput()->withErrors($validator);
        }

        if (Auth::attempt(['telp' => $request->telp, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('/');
        } else {
            alert()->error('Error', 'No. Telepon atau Password salah!');
            return back()->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function profile()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('profile', compact('user'));
    }

    public function profile_proses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nik' => 'required|unique:users,nik,' . auth()->user()->id,
            'telp' => 'required|unique:users,telp,' . auth()->user()->id,
            'password' => 'nullable|confirmed',
        ], [
            'nama.required' => 'Nama Lengkap harus diisi!',
            'nik.required' => 'NIK harus diisi!',
            'telp.required' => 'Nomor Telepon harus diisi!',
            'password.required' => 'Konfirmasi Password tidak sesuai!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Isi data dengan benar!');
            return back()->withInput()->withErrors($validator);
        }

        if ($request->password) {
            $password = bcrypt($request->password);
        } else {
            $password = auth()->user()->password;
        }

        $user = User::where('id', auth()->user()->id)->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'telp' => $request->telp,
            'password' => $password,
        ]);

        if (!$user) {
            alert()->error('Error', 'Gagal memperbarui Profile!');
            return back();
        }

        alert()->success('Success', 'Berhasil memperbarui Profile');
        return back();
    }
}
