@extends('layouts.app')

@section('title', 'Lihat Detail')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Pengaduan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/selesai') }}">Pengaduan</a>
                        </li>
                        <li class="breadcrumb-item active">Lihat</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lihat Pengaduan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Nama Pengguna</strong>
                                </div>
                                <div class="col-md-4">
                                    {{ $pengaduan->user->nama ?? null }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Keterangan</strong>
                                </div>
                                <div class="col-md-4">
                                    {{ $pengaduan->keterangan }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Alamat</strong>
                                </div>
                                <div class="col-md-4">
                                    {{ $pengaduan->alamat }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Patokan</strong>
                                </div>
                                <div class="col-md-4">
                                    {{ $pengaduan->patokan }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Tanggal di konfirmasi</strong>
                                </div>
                                <div class="col-md-4">
                                    {{ $pengaduan->tanggal_buat }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Tanggal di kerjakan</strong>
                                </div>
                                <div class="col-md-4">
                                    {{ $pengaduan->tanggal_proses }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Tanggal selesai</strong>
                                </div>
                                <div class="col-md-4">
                                    {{ $pengaduan->tanggal_selesai }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Foto Lokasi</h3>
                </div>
                <div class="card-body">

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            @if ($gambars->isEmpty())
                                <img class="mt-3" src="{{ asset('storage/uploads/gambaricon/imagenoimage.jpg') }}"
                                    alt="AdminLTELogo" height="180" width="200">
                            @else
                                <div class="d-flex flex-wrap mt-4">
                                    @foreach ($gambars as $gambar)
                                        <div class="col-md-3 col-sm-6 mb-4">
                                            <div class="image-container position-relative">
                                                <img src="{{ asset('storage/uploads/' . $gambar->gambar) }}"
                                                    alt="{{ $pengaduan->id }}" height="150" width="180"
                                                    class="w-100 rounded">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
