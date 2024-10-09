@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Pengaduan</h1>
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
                <div class="col-md-6">
                    <div class="card card-widget">
                        <div class="card-header">
                            <div class="user-block">
                                <img class="img-circle border" src="{{ asset('asset/person.png') }}" alt="Gambar Pengaduan">
                                <span class="username">
                                    {{ $pengaduan->user->nama }}
                                </span>
                                <span class="description">
                                    {{ Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('l, d F Y') }}
                                    -
                                    {{ Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('H:i') }} WIB
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
                            <div id="carousel-gambar" class="carousel slide mb-4" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($pengaduan->gambar as $key => $gambar)
                                        <li data-target="#carousel-gambar" data-slide-to="{{ $key }}"
                                            class="{{ $key == 0 ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($pengaduan->gambar as $key => $gambar)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img class="d-block w-100"
                                                src="{{ asset('storage/uploads/' . $gambar->gambar) }}"
                                                alt="Gambar {{ $key + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carousel-gambar" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-gambar" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <p>
                                {{ $pengaduan->keterangan }}
                                <br>
                                {{ $pengaduan->alamat }} ({{ $pengaduan->patokan }})
                            </p>
                            <p>
                                <strong>Petugas:</strong>
                                {{ $pengaduan->petugas->nama }}
                            </p>
                            <a href="https://maps.google.com/maps?q={{ $pengaduan->latitude }},{{ $pengaduan->longitude }}"
                                class="btn btn-secondary btn-sm">
                                <i class="fas fa-map-marked-alt"></i>
                                Maps
                            </a>
                            @if ($pengaduan->status == 'proses' || $pengaduan->status == 'selesai')
                                <hr class="mb-2">
                                <div class="alert alert-info alert-dismissible">
                                    <h5>Pengaduan {{ ucfirst($pengaduan->status) }}</h5>
                                    <span>Tanggal Proses :
                                        {{ Carbon\Carbon::parse($pengaduan->tanggal_proses)->translatedFormat('l, d F Y') }}</span>
                                    @if ($pengaduan->status == 'selesai')
                                        <br>
                                        <span>Tanggal Selesai :
                                            {{ Carbon\Carbon::parse($pengaduan->updated_at)->translatedFormat('l, d F') }}</span>
                                    @endif
                                </div>
                                @if ($pengaduan->status == 'selesai')
                                    <p class="mb-2">Bukti Selesai</p>
                                    <img src="{{ asset('storage/uploads/' . $pengaduan->foto) }}" alt="Bukti"
                                        class="w-100">
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-3">Komentar</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#modal-tambah">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <hr class="my-4">
                            @forelse ($pengaduan->komentar as $komentar)
                                <div class="mb-2">
                                    <div class="mb-2">
                                        <strong>{{ $komentar->user->nama }}</strong>
                                        <small class="text-muted float-right">
                                            {{ date('d M', strtotime($komentar->created_at)) }}
                                            -
                                            {{ date('H:i', strtotime($komentar->created_at)) }}
                                        </small>
                                    </div>
                                    <span>{{ $komentar->komentar }}</span>
                                </div>
                            @empty
                                <div class="border">
                                    <p class="text-center text-muted p-3">- Belum ada komentar yang ditambahkan -</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Komentar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('pengguna/postingan') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="pengaduan_id" id="pengaduan_id"
                                value="{{ $pengaduan->id }}">
                            <textarea class="form-control @error('komentar') is-invalid @enderror" name="komentar" id="komentar" cols="30"
                                rows="6" placeholder="Masukan Komentar">{{ old('komentar') }}</textarea>
                            @error('komentar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
@endsection
