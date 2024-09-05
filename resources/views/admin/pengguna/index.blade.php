@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengguna</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas fa-check"></i> Success!
                    </h5>
                    {{ session('success') }}
                </div>
            @endif
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
                    <h3 class="card-title">Data Pengguna</h3>
                    <div class="float-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px">No</th>
                                    <th>Nama</th>
                                    <th>Nomor Telepon</th>
                                    <th class="text-center" style="width: 80px">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penggunas as $pengguna)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $pengguna->nama }}</td>
                                        <td>{{ $pengguna->telp }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modal-edit-{{ $pengguna->id }}">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modal-hapus-{{ $pengguna->id }}">
                                                <i class="fas fa-trash"></i>
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
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/pengguna') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Pengguna</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))"
                                value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{ old('nik') }}"
                                minlength="16" maxlength="16">
                        </div>
                        <div class="form-group">
                            <label for="telp">
                                Nomor Telepon
                                <small>(08xxxxxxxxxx)</small>
                            </label>
                            <input type="text" class="form-control" id="telp" name="telp"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                value="{{ old('telp') }}" minlength="12" minlength="13">
                        </div>
                        <div class="form-group">
                            <label for="telp">Password</label>
                            <p class="text-muted">password default :
                                <strong>pengguna</strong>
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
    @foreach ($penggunas as $pengguna)
        <div class="modal fade" id="modal-edit-{{ $pengguna->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Perbarui Pengguna</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('admin/pengguna/' . $pengguna->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama Pengguna</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))"
                                    value="{{ $pengguna->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                    value="{{ $pengguna->nik }}" minlength="16" maxlength="16">
                            </div>
                            <div class="form-group">
                                <label for="telp">
                                    Nomor Telepon
                                    <small>(08xxxxxxxxxx)</small>
                                </label>
                                <input type="text" class="form-control" id="telp" name="telp"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                    value="{{ $pengguna->telp }}" minlength="12" minlength="13">
                            </div>
                            <div class="form-group">
                                <label for="telp">Password</label>
                                <button type="button" class="btn btn-warning d-block" data-dismiss="modal"
                                    data-toggle="modal" data-target="#modal-reset-{{ $pengguna->id }}">Reset
                                    Password</button>
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
        <div class="modal fade" id="modal-reset-{{ $pengguna->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus pengguna</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin reset password pengguna <strong>{{ $pengguna->nama }}</strong>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a href="{{ url('admin/pengguna/reset/' . $pengguna->id) }}" class="btn btn-warning">Reset</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-hapus-{{ $pengguna->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus pengguna</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin hapus pengguna <strong>{{ $pengguna->nama }}</strong>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <form action="{{ url('admin/pengguna/' . $pengguna->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
