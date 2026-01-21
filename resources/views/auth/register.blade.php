@extends('layouts.main')

@section('title', 'Register Siswa')

@section('content')
<div class="register-page-wrap">
    <div class="register-card-color">
        <div class="login-logo register-logo">
            <img src="{{ asset('images/Logo-Si-Ukur.png') }}" alt="Logo Si Ukur">
        </div>
        <div class="register-title">
            Register Siswa
        </div>
        <form method="POST" action="{{ route('register') }}" class="register-form-multicolor">
            @csrf
            <div class="register-form-grid">
                <div class="input-group-custom">
                    <label for="name">Nama</label>
                    <div class="input-nisn">
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="@error('name') is-invalid @enderror"
                            required autofocus
                            placeholder="Nama lengkap"
                        >
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group-custom">
                    <label for="email">Email</label>
                    <div class="input-nip">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="@error('email') is-invalid @enderror"
                            required
                            placeholder="Email aktif"
                        >
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group-custom">
                    <label for="nisn">NISN</label>
                    <div class="input-nisn">
                        <input
                            id="nisn"
                            type="text"
                            name="nisn"
                            value="{{ old('nisn') }}"
                            class="@error('nisn') is-invalid @enderror"
                            required
                            placeholder="Masukkan NISN"
                        >
                    </div>
                    @error('nisn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group-custom">
                    <label for="password">Kata Sandi</label>
                    <div class="input-sandi">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="@error('password') is-invalid @enderror"
                            required
                            placeholder="Kata sandi minimal 6 karakter"
                        >
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group-custom full">
                    <label for="password-confirm">Ulangi Kata Sandi</label>
                    <div class="input-sandi">
                        <input
                            id="password-confirm"
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="Ulangi kata sandi"
                        >
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-login-custom">
                Daftar
            </button>

            @if ($errors->any())
                <div class="invalid-feedback text-center mt-2">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
        </form>
        <div class="login-footer-link">
            Sudah punya akun? <a href="{{ route('login.siswa.form') }}">Login di sini</a>
        </div>
    </div>
</div>
@endsection
