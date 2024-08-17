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

    public function proses_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'nama.required' => 'Nama Lengkap harus diisi!',
            'jabatan.required' => 'Jabatan harus diisi!',
            'email.required' => 'Email Institusi harus diisi!',
            'email.email' => 'Email Institusi salah!',
            'password.required' => 'Password harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            alert()->error('Error!', 'Isi data dengan benar!');
            return back()->withInput()->with('error', $error);
        }

        User::create(array_merge($request->all(), [
            'password' => bcrypt($request->password),
            'role' => 'tamu'
        ]));

        alert()->success('Success', 'Berhasil melakukan pendaftaran');

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
