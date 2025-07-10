@extends('layouts.master-guru')

@section('content')
<div class="card bg-coklat fs-5">
    <div class="card-header">Edit KKM: {{ $kkm->kuis_id }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.kkm.update', $kkm) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>KKM <small class="text-muted">(minimal {{ $minKkm }}, maksimal {{ $maxKkm }})</small></label>
                <input type="number" name="kkm" class="form-control"
                       min="{{ $minKkm }}" max="{{ $maxKkm }}"
                       value="{{ $kkm->kkm }}" required step="1">
                <small class="form-text text-muted">
                    Nilai KKM minimal = {{ $minKkm }} (benar 1 soal), maksimal = 100.
                </small>
                @error('kkm')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary fs-5">Update</button>
            <a href="{{ route('admin.kkm.index') }}" class="btn btn-secondary fs-5">Kembali</a>
        </form>
    </div>
</div>
@endsection
