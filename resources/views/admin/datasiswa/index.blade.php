@extends('layouts.master-guru')

@section('content')
    <div class="card bg-coklat fs-5" style="box-shadow: 0 3px 24px #0000000e;">
        <div class="card-header d-flex justify-content-between align-items-center" style="background: none; border: none; font-size: 1.16em; font-weight: 700; color: #258fff;">
            <div class="float-start">
                Data Siswa
            </div>
            <div class="float-end">
                <a class="btn btn-success btn-sm fs-5 d-flex align-items-center gap-2" style="font-weight:600; box-shadow:0 2px 8px #1dd15e14;" href="{{ route('admin.datasiswa.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/>
                    </svg>
                    Tambah Siswa
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NISN</th>
                            <th>Register At</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->nisn ?? '-' }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('admin.datasiswa.edit', $item->id) }}" class="badge bg-info fs-5 text-decoration-none">Edit</a>
                                    <form method="POST" action="{{ route('admin.datasiswa.destroy', $item->id) }}"
                                          style="display: inline-block;"
                                          onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
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
            {{ $siswa->links() }}
        </div>
    </div>
    <br>
@endsection
