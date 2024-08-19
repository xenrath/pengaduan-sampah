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
                        <h4 class="modal-title">Tambah Pengaduan Menunggu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Pengaduan Menunggu</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                value="{{ old('nik') }}">
                        </div>
                        <div class="form-group">
                            <label for="telp">
                                Nomor Telepon
                                <small>(08xxxxxxxxxx)</small>
                            </label>
                            <input type="text" class="form-control" id="telp" name="telp"
                                value="{{ old('telp') }}">
                        </div>
                        <div class="form-group">
                            <label for="telp">Password</label>
                            <p class="text-muted">password default :
                                <strong>pengaduan</strong>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
