@extends('layouts.app')

@section('title', 'Pengaduan Terkini')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengaduan Terkini</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                @foreach ($pengaduans as $pengaduan)
                    <div class="col-md-6">
                        <div class="card card-widget">
                            <div class="card-header">
                                <div class="user-block">
                                    <img class="img-circle border" src="{{ asset('asset/person.png') }}"
                                        alt="Gambar Pengaduan">
                                    <span class="username">
                                        {{ $pengaduan->user->nama }}
                                    </span>
                                    <span class="description">
                                        {{ date('l, d F Y', strtotime($pengaduan->created_at)) }}
                                        -
                                        {{ date('H:i', strtotime($pengaduan->created_at)) }}
                                    </span>
                                </div>
                                <div class="float-right">
                                    @if ($pengaduan->status == 'konfirmasi')
                                        <span class="badge badge-primary">Konfirmasi</span>
                                    @elseif($pengaduan->status == 'proses')
                                        <span class="badge badge-info">Proses</span>
                                    @elseif($pengaduan->status == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <img class="img-fluid pad"
                                    src="{{ asset('storage/uploads/' . $pengaduan->gambar->first()->gambar) }}"
                                    alt="Photo">
                                <p>{{ $pengaduan->keterangan }}</p>
                                <p>{{ $pengaduan->alamat }} ({{ $pengaduan->patokan }})</p>
                                <button type="button" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-map-marked-alt"></i>
                                    Maps
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
