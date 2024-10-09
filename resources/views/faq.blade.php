@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Frequently Asked Questions</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="accordion">
                    <div class="card card-primary card-outline">
                        <a class="d-block w-100" data-toggle="collapse" href="#faq-1">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    Apa itu sistem pengaduan sampah?
                                </h4>
                            </div>
                        </a>
                        <div id="faq-1" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Sistem pengaduan sampah adalah cara bagi warga untuk melaporkan masalah tentang sampah di
                                desa,
                                seperti sampah yang menumpuk atau jadwal pengangkutan yang tidak sesuai.
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <a class="d-block w-100" data-toggle="collapse" href="#faq-2">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    Bagaimana cara mengajukan pengaduan tentang sampah?
                                </h4>
                            </div>
                        </a>
                        <div id="faq-2" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Anda bisa mengajukan pengaduan melalui aplikasi ini. Cukup isi formulir dengan jelas dan
                                sertakan lokasi serta kontak yang bisa dihubungi.
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <a class="d-block w-100" data-toggle="collapse" href="#faq-3">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    Berapa lama proses penanganan pengaduan sampah?
                                </h4>
                            </div>
                        </a>
                        <div id="faq-3" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Kami berusaha untuk menanggapi setiap pengaduan dalam waktu 7 hari kerja dan akan memberikan
                                kabar tentang penyelesaian masalahnya.
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <a class="d-block w-100" data-toggle="collapse" href="#faq-4">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    Apa yang harus saya lakukan jika saya tidak mendapatkan respons setelah mengajukan
                                    pengaduan?
                                </h4>
                            </div>
                        </a>
                        <div id="faq-4" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Jika tidak ada respons dalam waktu yang ditentukan, Anda bisa menghubungi nomor kontak yang
                                ada di aplikasi atau mengirim email untuk menanyakan status pengaduan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
