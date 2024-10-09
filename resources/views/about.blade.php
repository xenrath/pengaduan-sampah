@extends('layouts.app')

@section('title', 'About')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">About</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tentang Sistem</h3>
                </div>
                <div class="card-body">
                    <p>Sistem Pengaduan Sampah adalah cara mudah bagi warga desa untuk melaporkan masalah yang berkaitan
                        dengan sampah. Kami ingin membantu menciptakan lingkungan yang bersih dan nyaman untuk semua. Dengan
                        sistem ini, Anda bisa:</p>
                    <ul>
                        <li>Mengadu tentang sampah yang menumpuk di jalan atau di tempat umum.</li>
                        <li>Memberitahukan kami jika jadwal pengangkutan sampah tidak sesuai.</li>
                        <li>Melaporkan lokasi pembuangan sampah yang tidak seharusnya.</li>
                    </ul>
                    <p>Kami berkomitmen untuk segera menanggapi setiap laporan yang masuk, sehingga masalah sampah bisa
                        segera ditangani. Dengan bekerja sama, kita bisa menjaga kebersihan desa dan hidup lebih nyaman.</p>
                    <p>Mari bersama-sama menjaga lingkungan kita agar tetap bersih!</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Info</h3>
                </div>
                <div class="card-body">
                    <p>Jika ada memerlukan bantuan lebih lanjut:</p>
                    <ul>
                        <li>Kirim email ke: support@pengaduansampah.com</li>
                        <li>Hubungi hotline: 0800-123-4567</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
