@extends('layouts.app')

@section('title', 'Pengaduan Proses')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengaduan Proses</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pengaduan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px">No</th>
                                    <th>Nama Pengguna</th>
                                    <th>Keterangan</th>
                                    <th>Petugas</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 20px">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaduans as $pengaduan)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $pengaduan->user->nama }}</td>
                                        <td>{{ $pengaduan->keterangan }}</td>
                                        <td>{{ $pengaduan->petugas->nama }}</td>
                                        <td>
                                            @if ($pengaduan->status == 'konfirmasi')
                                                <span class="badge badge-primary">Konfirmasi</span>
                                            @else
                                                <span class="badge badge-info">Proses</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#modal-lihat-{{ $pengaduan->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
    <!-- /.card -->
    @foreach ($pengaduans as $pengaduan)
        <div class="modal fade" id="modal-lihat-{{ $pengaduan->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Pengaduan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Nama Pengguna</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengaduan->user->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Keterangan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengaduan->keterangan }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Alamat</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengaduan->alamat }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Patokan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengaduan->patokan }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Tanggal Buat</strong>
                            </div>
                            <div class="col-md-6">
                                {{ Carbon\Carbon::parse($pengaduan->tanggal_buat)->format('H:i') }} WIB,
                                {{ Carbon\Carbon::parse($pengaduan->tanggal_buat)->format('d F Y') }}
                            </div>
                        </div>
                        @if ($pengaduan->tanggal_proses)
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Tanggal Proses</strong>
                                </div>
                                <div class="col-md-6">
                                    {{ Carbon\Carbon::parse($pengaduan->tanggal_proses)->format('d F Y') }}
                                </div>
                            </div>
                        @endif
                        @if ($pengaduan->tanggal_selesai)
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Tanggal Selesai</strong>
                                </div>
                                <div class="col-md-6">
                                    {{ Carbon\Carbon::parse($pengaduan->tanggal_selesai)->format('H:i') }} WIB,
                                    {{ Carbon\Carbon::parse($pengaduan->tanggal_selesai)->format('d F Y') }}
                                </div>
                            </div>
                        @endif
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Lokasi</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="https://maps.google.com/maps?q={{ $pengaduan->latitude }},{{ $pengaduan->longitude }}"
                                    class="btn btn-secondary btn-sm" target="_blank">Lihat Maps</a>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Gambar</strong>
                            </div>
                            <div class="col-md-6">
                                @foreach ($pengaduan->gambar as $gambar)
                                    <img src="{{ asset('storage/uploads/' . $gambar->gambar) }}" class=" w-100 mb-2"
                                        alt="Gambar">
                                @endforeach
                            </div>
                        </div>
                        @if ($pengaduan->petugas_id)
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Petugas</strong>
                                </div>
                                <div class="col-md-6">
                                    {{ $pengaduan->petugas->nama }}
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
