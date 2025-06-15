@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📋 Daftar Donasi</h2>
        <a href="{{ route('donasi.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Donasi
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donasis as $donasi)
                    <tr>
                        <td>{{ $donasi->nama }}</td>
                        <td>{{ $donasi->judul }}</td>
                        <td>Rp{{ number_format($donasi->jumlah, 0, ',', '.') }}</td>
                        <td>
                            @if($donasi->status === 'Disetujui')
                                <span class="badge bg-success">{{ $donasi->status }}</span>
                            @elseif($donasi->status === 'Ditolak')
                                <span class="badge bg-danger">{{ $donasi->status }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $donasi->status }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('donasi.edit', $donasi->id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('donasi.destroy', $donasi->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada donasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
