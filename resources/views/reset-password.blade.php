<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password | Pengaduan Sampah</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>

<body>

    @include('sweetalert::alert')

    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="">
                    <b>Pengaduan</b>
                    Sampah
                </a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <form action="" method="post" id="form-submit">
                        @csrf
                        @method('post')
                        <div class="form-group mb-2">
                            <div class="input-group">
                                <input type="tel" class="form-control @error('telp') is-invalid @enderror"
                                    name="telp" placeholder="Nomor Telepon" value="{{ old('telp') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-phone"></span>
                                    </div>
                                </div>
                                @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="text-muted">(08xxxxxxxxxx)</small>
                            <div class="text-right">
                                <button type="button" class="btn btn-secondary btn-sm" onclick="kirim_kode()">Kirim
                                    Kode</button>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" name="kode" placeholder="Kode OTP"
                                value="{{ old('kode') }}"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="16">
                            @error('kode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary btn-block my-4"
                                onclick="proses_kode()">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
    <script>
        function kirim_kode() {
            $('#form-submit').attr('action', "{{ url('reset-password/kode') }}");
            $('#form-submit').submit();
        }

        function proses_kode() {
            $('#form-submit').attr('action', "{{ url('reset-password/proses') }}");
            $('#form-submit').submit();
        }
    </script>
</body>

</html>
