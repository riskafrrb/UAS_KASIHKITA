@extends('layouts.app')

@section('title', 'Dashboard Pengguna - Kasih Kita')

@section('content')
<nav style="background-color: #f8f9fa; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <h3 style="margin: 0; color: #0b1f47;">Halo, {{ Auth::user()->name }}</h3>
    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
        @auth
            <a href="/" class="btn btn-sm btn-outline-success">Beranda</a>
            <a href="{{ route('pengajuan') }}" class="btn btn-sm btn-outline-info">Pengajuan</a>
            <a href="{{ route('riwayat') }}" class="btn btn-sm btn-outline-info">Riwayat</a>
            <a href="{{ route('pemasukan') }}" class="btn btn-sm btn-outline-info">Pemasukan</a>
        @endauth
    </div>
</nav>

{{-- Donasi yang disetujui --}}
@if($donasis->isEmpty())
    <div class="text-center mt-5 text-muted">Belum ada donasi yang disetujui.</div>
@else
    <div class="container mt-5">
        <h4 class="mb-4">Donasi yang Telah Disetujui</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($donasis as $donasi)
                <div class="bg-white p-4 rounded-lg shadow border">
                    <h5 class="font-bold">{{ $donasi->nama }}</h5>
                    <p class="text-gray-600">Jumlah: Rp{{ number_format($donasi->jumlah, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500">{{ $donasi->keterangan }}</p>
                    <span class="inline-block px-2 py-1 mt-2 text-xs font-semibold bg-green-100 text-green-700 rounded">
                        {{ $donasi->status }}
                    </span>

                    {{-- Tombol Donasi --}}
                    <div class="mt-3">
                        <a href="{{ route('donasi.form', $donasi->id) }}" class="mt-3 inline-block text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

@endsection
