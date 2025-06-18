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
<div class="container py-5 text-white bg-gray-900">
    <h2 class="text-2xl font-bold mb-4">Hubungi Kami</h2>
    <p class="text-gray-500">Silakan hubungi kami melalui email di <strong>kontak@kasihkita.id</strong>.</p>
</div>
@endsection
