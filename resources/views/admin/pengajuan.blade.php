@extends('layouts.app')

@section('title', 'Kelola Pengajuan Donasi')

@section('content')
<nav style="background-color: #f8f9fa; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <h3 style="margin: 0; color: #0b1f47;">Halo, Admin {{ Auth::user()->name }}</h3>
    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
        @auth
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-primary">Dashboard</a>
            <a href="{{ route('admin.pengajuan') }}" class="btn btn-sm btn-outline-info">Pengajuan</a>
            <a href="{{ route('admin.riwayat') }}" class="btn btn-sm btn-outline-info">Riwayat</a>
        @endauth
    </div>
</nav>
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
                <th>Tanggal Pengajuan</th>
                <th>Tanggal Disetujui</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donasis as $donasi)
                <tr>
                    <td>{{ $donasi->judul }}</td>
                    <td>Rp{{ number_format($donasi->target, 0, ',', '.') }}</td>
                    <td>{{ $donasi->keterangan }}</td>
                    <td>
                        <span class="badge bg-{{ $donasi->status == 'Disetujui' ? 'success' : ($donasi->status == 'Ditolak' ? 'danger' : 'secondary') }}">
                            {{ $donasi->status }}
                        </span>
                    </td>
                    <td>{{ $donasi->created_at->format('d M Y H:i') }}</td>
                    <td>
                        @if ($donasi->status === 'Disetujui')
                            {{ $donasi->updated_at->format('d M Y H:i') }}
                        @else
                            -
                        @endif
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
