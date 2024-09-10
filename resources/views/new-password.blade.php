<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Baru | Pengaduan Sampah</title>
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
                    <form action="{{ url('new-password') }}" method="post">
                        @csrf
                        <input type="hidden" class="form-control" name="telp"
                            value="{{ old('telp', session('telp')) }}">
                        <div class="form-group mb-2">
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="Masukan Password Baru" value="{{ old('password') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text" style="cursor: pointer;" id="password-toggle">
                                        <span id="password-icon" class="fas fa-eye"></span>
                                    </div>
                                </div>
                            </div>
                            @error('password')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <div class="input-group">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Masukan Konfirmasi Password"
                                    value="{{ old('password_confirmation') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text" style="cursor: pointer;"
                                        id="konfirmasi-password-toggle">
                                        <span id="password-icon" class="fas fa-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block mt-4">Simpan</button>
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
        $(document).ready(function() {
            $('#password-toggle').click(function() {
                var passwordInput = $('input[name="password"]');
                var passwordIcon = $('#password-icon');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            $('#konfirmasi-password-toggle').click(function() {
                var passwordInput = $('input[name="password_confirmation"]');
                var passwordIcon = $('#password-icon');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
</body>

</html>
