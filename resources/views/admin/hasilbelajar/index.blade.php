@extends('layouts.master-guru')

@section('content')
    <div class="card bg-coklat fs-5" style="box-shadow: 0 3px 24px #0000000e;">
        <div class="card-header d-flex justify-content-between align-items-center" style="background: none; border: none; font-size: 1.16em; font-weight: 700; color: #258fff;">
            <div class="float-start">
                Data Hasil Belajar Siswa
            </div>
            <form method="GET" class="d-flex gap-2">
                <select name="kuis_id" class="form-select form-select-sm fs-5" style="max-width:200px;">
                    <option value="">-- Semua Hasil Belajar --</option>
                    @foreach($kuisIds as $kuis)
                        <option value="{{ $kuis }}" {{ $kuisDipilih == $kuis ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('-', ' ', $kuis)) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary btn-sm fs-5">Filter</button>
            </form>
        </div>

        <div class="card-body">
            <div class="mb-3 d-flex flex-wrap gap-2">
                <a href="{{ route('admin.hasilbelajar.export', ['format' => 'excel', 'kuis_id' => request('kuis_id')]) }}"
                   class="btn btn-success btn-sm fs-5 d-flex align-items-center gap-2" style="font-weight:600; box-shadow:0 2px 8px #1dd15e14;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                    </svg>
                    Export Excel
                </a>
                <a href="{{ route('admin.hasilbelajar.export', ['format' => 'pdf', 'kuis_id' => request('kuis_id')]) }}"
                   class="btn btn-danger btn-sm fs-5 d-flex align-items-center gap-2" style="font-weight:600; box-shadow:0 2px 8px #fa465419;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                    </svg>
                    Export PDF
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Nilai</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai as $i => $row)
                            <tr>
                                <td>{{ $loop->iteration + ($nilai->firstItem() - 1) }}</td>
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->user->nisn ?? '-' }}</td>
                                <td>{{ $row->skor }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('j/n/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('H.i.s') }}</td>
                                <td>
                                    <form action="{{ route('admin.hasilbelajar.destroy', $row->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="badge bg-danger border-0 fs-5">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer custom-pagination">
            {{ $nilai->links() }}
        </div>
    </div>
    <br>
@endsection
