@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Update Profile</h5>
                </div>
                <form action="{{ url('profile') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama', $user->nama) }}"
                                onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                name="nik" value="{{ old('nik', $user->nik) }}"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="16"
                                maxlength="16">
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="telp">No. Telepon</label>
                            <input type="tel" id="telp" name="telp"
                                class="form-control @error('telp') is-invalid @enderror"
                                value="{{ old('telp', $user->telp) }}"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="12"
                                minlength="13">
                            @error('telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="form-group mb-2">
                            <label for="foto">Foto</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar"
                                    accept="image/*">
                                <label class="custom-file-label" for="gambar">Pilih Foto</label>
                            </div>
                        </div> --}}
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-2">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password" class="form-control"
                                            value="{{ old('password') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text" style="cursor: pointer;" id="password-toggle">
                                                <span id="password-icon" class="fas fa-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <small>(Kosongkan saja jika tidak ingin diubah)</small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-2">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control" value="{{ old('password_confirmation') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text" style="cursor: pointer;"
                                                id="password-confirm-toggle">
                                                <span id="password-confirm-icon" class="fas fa-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#password-toggle').click(function() {
                togglePasswordVisibility('password', 'password-icon');
            });

            $('#password-confirm-toggle').click(function() {
                togglePasswordVisibility('password_confirmation', 'password-confirm-icon');
            });

            function togglePasswordVisibility(inputId, iconId) {
                var passwordInput = $('#' + inputId);
                var passwordIcon = $('#' + iconId);

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            }
        });
    </script>
@endsection
