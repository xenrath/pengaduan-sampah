<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Pengaduan Sampah</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>

<body>

    {{-- @include('sweetalert::alert') --}}

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
                    <p class="login-box-msg">Masukan nomor telepon dan password</p>
                    <form action="{{ url('login') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group mb-2">
                            <div class="input-group">
                                <input type="tel" class="form-control" name="telp" placeholder="Nomor Telepon"
                                    value="{{ old('telp') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-telp"></span>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">(08xxxxxxxxxx)</small>
                        </div>
                        <div class="form-group mb-2">
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-4">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
</body>

</html>
