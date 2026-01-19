@extends('layouts.main')

@section('title', 'Login Guru')

@section('content')
<div class="login-page-wrap">
    <div class="login-card-color">
        <div class="login-logo">
            <img src="{{ asset('images/Logo-Si-Ukur.png') }}" alt="Logo Si Ukur">
        </div>
        <div class="login-title">
            Login Guru
        </div>
        <form method="POST" action="{{ route('login.guru') }}" class="login-form-multicolor">
            @csrf
            <div class="input-group-custom">
                <label for="identity">NIP</label>
                <div class="input-nip">
                    <input
                        id="identity"
                        type="text"
                        class="@error('identity') is-invalid @enderror"
                        name="identity"
                        value="{{ old('identity') }}"
                        required autocomplete="identity"
                        autofocus
                        placeholder="Masukkan NIP"
                    >
                </div>
                @error('identity')
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
                        class="@error('password') is-invalid @enderror"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan Kata Sandi"
                    >
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn-login-custom">
                Masuk
            </button>
            @if ($errors->has('identity') || $errors->has('password'))
                <div class="invalid-feedback text-center mt-2">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
