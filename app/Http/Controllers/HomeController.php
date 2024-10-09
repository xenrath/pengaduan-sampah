<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return redirect('admin');
            } elseif (auth()->user()->isPetugas()) {
                return redirect('petugas');
            } elseif (auth()->user()->isPengguna()) {
                return redirect('pengguna');
            }
        }

        return redirect('login');
    }

    public function faq()
    {
        return view('faq');
    }
    
    public function about()
    {
        return view('about');
    }
}
