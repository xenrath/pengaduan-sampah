<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        $petugases = User::where('role', 'petugas')->get();

        return view('admin.petugas.index', compact('petugases'));
    }
}
