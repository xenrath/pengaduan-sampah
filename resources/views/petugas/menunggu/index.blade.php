@extends('layouts.app')

@section('title', 'Data Pengaduan Menunggu')

@section('content')

    <div id="loadingSpinner" style="display: flex; align-items: center; justify-content: center; height: 100vh;">
        <i class="fas fa-spinner fa-spin" style="font-size: 3rem;"></i>
    </div>
    <!-- Content Header (Page header) -->
    <div class="content-header" style="display: none;" id="mainContent">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengaduan Menunggu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Pengaduan Menunggu</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="display: none;" id="mainContentSection">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas fa-check"></i> Berhasil !
                    </h5>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas fa-ban"></i> Gagal Menyimpan!
                    </h5>
                    @foreach (session('error') as $error)
                        - {{ $error }} <br>
                    @endforeach
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pengaduan Menunggu</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Alamat</th>
                                <th>Keterangan</th>
                                <th class="text-center" width="80">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduans as $pengaduan)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $pengaduan->alamat }}</td>
                                    <td>{{ $pengaduan->keterangan }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('petugas/menunggu/' . $pengaduan->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modal-menunggu-{{ $pengaduan->id }}">
                                            <i class="fas fa-clock"></i>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-menunggu-{{ $pengaduan->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Proses</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div style="text-align: left;">
                                                    <form action="{{ url('petugas/proses-pengaduan/' . $pengaduan->id) }}"
                                                        method="POST" enctype="multipart/form-data" autocomplete="off">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="tanggal_proses">Pilih Tanggal Proses</label>
                                                                <input class="form-control" id="tanggal_proses"
                                                                    name="tanggal_proses" type="date"
                                                                    value="{{ Request::get('tanggal_proses') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="card-footer text-right">
                                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                id="submitBtn">Proses</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                document.getElementById("loadingSpinner").style.display = "none";
                document.getElementById("mainContent").style.display = "block";
                document.getElementById("mainContentSection").style.display = "block";
            }, 100);
        });
    </script>
@endsection
