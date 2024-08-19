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
                                    <th class="text-center" style="width: 80px">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaduans as $pengaduan)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $pengaduan->user->nama }}</td>
                                        <td>{{ $pengaduan->keterangan }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#modal-tolak-{{ $pengaduan->id }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal-konfirmasi-{{ $pengaduan->id }}">
                                                <i class="fas fa-check"></i>
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
                        <h4 class="modal-title">Tambah Pengaduan Menunggu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('admin/pengaduan') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            Yakin tolak pengaduan dari <strong>{{ $pengaduan->user->nama }}</strong>?
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <form action="{{ url('admin/pengaduan-menunggu/' . $pengaduan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-konfirmasi-{{ $pengaduan->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Pengaduan Menunggu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('admin/pengaduan') }}" method="POST">
                        @csrf
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
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
