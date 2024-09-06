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
                    <p class="login-box-msg">Masukan nomor telepon dan password</p>
                    <form action="{{ url('login') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group mb-2">
                            <div class="input-group">
                                <input type="tel" class="form-control @error('telp') is-invalid @enderror"
                                    name="telp" placeholder="Nomor Telepon" value="{{ old('telp') }}"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="12"
                                    minlength="13">
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
                        </div>
                        <div class="form-group mb-2">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password"
                                    placeholder="Masukan password" value="{{ old('password') }}">
                                <div class="input-group-append">
                                    {{-- <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div> --}}
                                    <div class="input-group-text" style="cursor: pointer;" id="password-toggle">
                                        <span id="password-icon" class="fas fa-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block my-4">Login</button>
                            <a href="{{ url('register') }}">Belum punya akun? Daftar</a>
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
        });
    </script>
</body>

</html>
