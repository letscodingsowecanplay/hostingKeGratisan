@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <!-- Ilustrasi Anak: Desktop & Tablet -->
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
            <img src="{{ asset('images/login-siswa.png') }}"
                 alt="Ilustrasi Siswa SD"
                 class="img-fluid"
                 style="max-width:500px;">
        </div>
        <!-- Form Login -->
        <div class="col-md-6 col-12 d-flex flex-column justify-content-center align-items-center">
            <div class="card bg-coklat fs-5 w-100" style="max-width: 420px;">
                <div class="card-header text-center">
                    <b>{{ __('Masuk Sebagai Siswa') }}</b>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 row">
                            <label for="identity" class="col-md-4 col-form-label text-md-end">NISN</label>
                            <div class="col-md-8">
                                <input
                                    id="identity" type="text" class="form-control @error('identity') is-invalid @enderror" name="identity" value="{{ old('identity') }}"
                                    required autocomplete="identity" autofocus
                                >
                                @error('identity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Kata Sandi</label>
                            <div class="col-md-8">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                >
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-0 row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn bg-coklap btn-masuk fs-5 w-100">
                                    Masuk
                                </button>
                            </div>
                        </div>

                        @if ($errors->has('identity') || $errors->has('password'))
                            <div class="alert alert-danger mt-3">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                    </form>

                    <div class="text-center mt-4">
                        <p>Belum memiliki akun? 
                            <a href="{{ route('register') }}" class="text-decoration-underline text-orange fw-bold">
                                Daftar di sini
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ilustrasi Anak (Mobile, tampil di atas login card) -->
        <div class="col-12 d-md-none text-center mb-3">
            <img src="{{ asset('images/login-siswa.png') }}"
                 alt="Ilustrasi Siswa SD"
                 class="img-fluid"
                 style="max-width:180px;">
        </div>
    </div>
</div>
@endsection
