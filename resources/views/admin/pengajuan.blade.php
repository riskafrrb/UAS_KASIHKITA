@extends('layouts.app')

@section('title', 'Kelola Pengajuan Donasi')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Kelola Pengajuan Donasi</h2>

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donasis as $donasi)
                <tr>
                    <td>{{ $donasi->nama }}</td>
                    <td>Rp{{ number_format($donasi->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $donasi->keterangan }}</td>
                    <td>
                        <span class="badge bg-{{ $donasi->status == 'Disetujui' ? 'success' : ($donasi->status == 'Ditolak' ? 'danger' : 'secondary') }}">
                            {{ $donasi->status }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.ubah_status', $donasi->id) }}" method="POST" style="display: inline-flex; gap: 4px;">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option disabled selected>Ubah Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
