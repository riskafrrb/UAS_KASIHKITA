@extends('layouts.app')

@section('title', 'Kasih Kita - Beranda')

@section('content')
<nav style="background-color: #f8f9fa; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <h3 style="margin: 0; color: #0b1f47;">Kasih Kita</h3>
    <div style="display: flex; align-items: center; gap: 10px;">
        @auth
            <a href="/" class="btn btn-sm btn-outline-success">Beranda</a>
            <a href="{{ route('tentang') }}" class="btn btn-sm btn-outline-info">Tentang Kami</a>
            <a href="{{ route('kontak') }}" class="btn btn-sm btn-outline-warning">Kontak</a>
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-info">Dashboard</a>
        @else
            <a href="/" class="btn btn-sm btn-outline-success">Beranda</a>
            <a href="{{ route('tentang') }}" class="btn btn-sm btn-outline-info">Tentang Kami</a>
            <a href="{{ route('kontak') }}" class="btn btn-sm btn-outline-warning">Kontak</a>

        @endauth
    </div>
</nav>

@if($donasis->isEmpty())
    <div class="text-center mt-5 text-muted">Belum ada donasi yang disetujui.</div>
@else
    <div class="container mt-5">
        <h4 class="mb-4">Donasi yang Telah Disetujui</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($donasis as $donasi)
            <div class="bg-white p-4 rounded-lg shadow border">
                {{-- Judul Donasi --}}
                <h4 class="text-lg font-bold text-gray-800 mb-1">{{ $donasi->judul }}</h4>

                {{-- Nama Penerima --}}
                <p class="text-sm text-gray-700 mb-1">Penerima: <strong>{{ $donasi->penerima }}</strong></p>

                {{-- Target Donasi --}}
                <p class="text-sm text-gray-700 mb-1">Target: Rp{{ number_format($donasi->target, 0, ',', '.') }}</p>

                {{-- Keterangan --}}
                <p class="text-sm text-gray-500">{{ $donasi->keterangan }}</p>

                {{-- Tombol Donasi --}}
                <div class="mt-3">
                    <a href="{{ route('donasi.form', $donasi->id) }}" class="inline-block text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                        Donasi Sekarang
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endif
@endsection
