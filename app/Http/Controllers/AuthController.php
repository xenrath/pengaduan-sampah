<?php

namespace App\Http\Controllers;

use App\Models\Otp;
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
            'nik' => 'required|min:16|unique:users,nik',
            'telp' => 'required|unique:users,telp',
            'password' => 'required|confirmed'
        ], [
            'nama.required' => 'Nama Lengkap harus diisi!',
            'nik.required' => 'NIK harus diisi!',
            'nik.unique' => 'NIK sudah digunakan!',
            'nik.min' => 'Masukan NIK dengan benar!',
            'telp.required' => 'Nomor Telepon harus diisi!',
            'telp.unique' => 'Nomor Telepon sudah digunakan!',
            'password.required' => 'Password harus diisi!',
            'password.confirmed' => 'Konfirmasi Password tidak sesuai!',
        ]);

        $nol = substr($request->telp, 0, 1);

        if ($validator->fails()) {
            alert()->error('Error!', 'Isi data dengan benar!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $user = User::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'telp' => $request->telp,
            'password' => bcrypt($request->password),
            'verifikasi' => '0',
            'role' => 'pengguna'
        ]);

        if ($user) {
            $this->otp($user->telp);
        }

        return redirect('kode')->with('telp', $user->telp, 'masukan kode verifikasi');
    }

    public function otp($telp)
    {
        $user = Otp::where('telp')->first();

        $curl = curl_init();
        $otp = rand(100000, 999999);

        if ($user) {
            Otp::where('telp', $telp)->update([
                'kode' => $otp
            ]);
        } else {
            Otp::create([
                'telp' => $telp,
                'kode' => $otp
            ]);
        }

        $data = [
            'target' => $telp,
            'message' => "Kode OTP : " . $otp
        ];

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

        $result = curl_exec($curl);

        curl_close($curl);
    }

    public function kode_otp2()
    {
        $otp = Otp::get();

        return view('otp')->with('success', 'Berhasil melakukan pendaftaran');
    }

    function kode_verifikasi(Request $request)
    {
        $otp = Otp::where('telp', $request->telp)->first();

        if ($otp === null) {
            return back()->with('error', 'Kode verifikasi tidak ditemukan atau sudah kadaluarsa.');
        }

        if ($request->kode == $otp->kode) {
            User::where('telp', $request->telp)
                ->update([
                    'verifikasi' => '1'
                ]);
            return redirect('login')->with('success', 'Kode verifikasi cocok, silakan login');
        } else {
            return back()->with('error', 'Kode verifikasi salah');
        }
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