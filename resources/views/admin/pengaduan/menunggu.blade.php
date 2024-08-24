@extends('layouts.app')

@section('title', 'Pengaduan Menunggu')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengaduan Menunggu</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas fa-ban"></i> Error!
                    </h5>
                    @foreach (session('error') as $error)
                        - {{ $error }} <br>
                    @endforeach
                </div>
            @endif
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
                                    <th class="text-center" style="width: 100px">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaduans as $pengaduan)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $pengaduan->user->nama }}</td>
                                        <td>{{ $pengaduan->keterangan }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modal-tolak-{{ $pengaduan->id }}">
                                                Tolak
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#modal-konfirmasi-{{ $pengaduan->id }}">
                                                Terima
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
        <div class="modal fade" id="modal-tolak-{{ $pengaduan->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tolak Pengaduan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('admin/pengaduan-menunggu/tolak/' . $pengaduan->id) }}"" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            Yakin tolak pengaduan dari <strong>{{ $pengaduan->user->nama }}</strong>?
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="alasan">Keterangan</label>
                                <textarea type="text" class="form-control" id="alasan" name="alasan" placeholder="Masukan keterangan">{{ old('alasan') }}</textarea>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="submitBtn">Tolak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-konfirmasi-{{ $pengaduan->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Pengaduan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Nama Pengguna</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengaduan->user->nama }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Keterangan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengaduan->keterangan }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Alamat</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengaduan->alamat }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Patokan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengaduan->patokan }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Lokasi</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="https://maps.google.com/maps?q={{ $pengaduan->latitude }},{{ $pengaduan->longitude }}"
                                    class="btn btn-secondary btn-sm" target="_blank">Lihat Maps</a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Gambar</strong>
                            </div>
                            <div class="col-md-6">
                                @foreach ($pengaduan->gambar as $gambar)
                                    <img src="{{ asset('storage/uploads/' . $gambar->gambar) }}" class="img-thumbnail mb-2"
                                        alt="Gambar">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <form action="{{ url('admin/pengaduan-menunggu/konfirmasi/' . $pengaduan->id) }}" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="petugas_id">Petugas</label>
                                <select class="custom-select form-control" id="petugas_id" name="petugas_id">
                                    <option value="">- Pilih Petugas -</option>
                                    @foreach ($petugass as $petugas)
                                        <option value="{{ $petugas->id }}"
                                            {{ old('petugas_id') == $petugas->id ? 'selected' : '' }}>
                                            {{ $petugas->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Selesaikan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
