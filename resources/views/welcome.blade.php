@extends('layouts.app')

@section('title', 'Kasih Kita - Beranda')

@section('content')
<nav style="background-color: #f8f9fa; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <h3 style="margin: 0; color: #0b1f47;">Kasih Kita</h3>
    <div style="display: flex; align-items: center; gap: 10px;">
        @auth
            {{-- Menu setelah login --}}
            <a href="/" class="btn btn-sm btn-outline-success">Beranda</a>
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-info">Tentang Kami</a>
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-warning">Kontak</a>
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-info">Dashboard</a>
        @else
            {{-- Menu sebelum login --}}
            <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-sm btn-outline-primary">Daftar</a>
        @endauth
    </div>
</nav>

{{-- Tambahan: Menampilkan donasi yang disetujui --}}
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
                        @auth
    <a href="{{ route('donasi.form', $donasi->id) }}" class="mt-3 inline-block text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
        Donasi Sekarang
    </a>
@else
    <a href="{{ route('login') }}" class="mt-3 inline-block text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
        Login untuk Berdonasi
    </a>
@endauth

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif


@endsection
