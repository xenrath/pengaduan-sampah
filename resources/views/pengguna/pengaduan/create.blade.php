@extends('layouts.app')

@section('title', 'Buat Pengaduan')

@section('content')
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buat Pengaduan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('pengguna/pengaduan') }}">Buat Pengaduan</a></li>
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
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
            <form action="{{ url('pengguna/pengaduan') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Buat Pengaduan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat">{{ old('alamat') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="patokan">Patokan</label>
                            <input type="text" class="form-control" id="patokan" name="patokan"
                                placeholder="masukkan patokan" value="{{ old('patokan') }}">
                        </div>
                        <div class="form-group">
                            <label style="font-size:14px" for="map">Peta</label>
                            <div id="map"></div>
                            <input type="hidden" id="latitude" value="{{ old('latitude') }}" name="latitude" />
                            <input type="hidden" id="longitude" value="{{ old('longitude') }}" name="longitude" />
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukan keterangan">{{ old('alamat') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="gambar">Foto Lokasi</label>
                            <input class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar[]"
                                type="file" accept="image/*" multiple />
                            @error('gambar')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="reset" class="btn btn-secondary" id="btnReset">Reset</button>
                        <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var defaultLat = -6.867241559586205;
            var defaultLng = 109.13766080270332;
            var latitude = parseFloat(document.getElementById('latitude').value) || defaultLat;
            var longitude = parseFloat(document.getElementById('longitude').value) || defaultLng;

            var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var geocoder = L.Control.Geocoder.nominatim();
            L.Control.geocoder({
                geocoder: geocoder
            }).addTo(map);

            var marker = L.marker([latitude, longitude], {
                draggable: true
            }).addTo(map);

            marker.on('moveend', function(event) {
                var position = event.target.getLatLng();
                document.getElementById('latitude').value = position.lat;
                document.getElementById('longitude').value = position.lng;
            });

            map.on('click', function(event) {
                var latlng = event.latlng;
                marker.setLatLng(latlng);
                document.getElementById('latitude').value = latlng.lat;
                document.getElementById('longitude').value = latlng.lng;
            });
        });
    </script>
@endsection
