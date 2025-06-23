@extends('layouts.main')

@section('title', 'Login Siswa')

@section('content')
<div class="login-page-wrap">
    <div class="login-card-color">
        <div class="login-logo">
            <img src="{{ asset('images/Logo-Si-Ukur.png') }}" alt="Logo Si Ukur">
        </div>
        <div class="login-title">
            Login Siswa
        </div>
        <form method="POST" action="{{ route('login.siswa') }}" class="login-form-multicolor">
            @csrf
            <div class="input-group-custom">
                <label for="identity">NISN</label>
                <div class="input-nisn">
                    <input
                        id="identity"
                        type="text"
                        class="@error('identity') is-invalid @enderror"
                        name="identity"
                        value="{{ old('identity') }}"
                        required autocomplete="identity"
                        autofocus
                        placeholder="Masukkan NISN"
                    >
                </div>
                @error('identity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn-login-custom">
                Masuk
            </button>
            @if ($errors->has('identity'))
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
