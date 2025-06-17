@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<nav style="background-color: #f8f9fa; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <h3 style="margin: 0; color: #0b1f47;">Kasih Kita</h3>
    <div style="display: flex; align-items: center; gap: 10px;">
        @auth
            {{-- Menu setelah login --}}
            <a href="/" class="btn btn-sm btn-outline-success">Beranda</a>
            <a href="{{ route('tentang') }}" class="btn btn-sm btn-outline-info">Tentang Kami</a>
            <a href="{{ route('kontak') }}" class="btn btn-sm btn-outline-warning">Kontak</a>
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-info">Dashboard</a>
        @else
            {{-- Menu sebelum login --}}
            <a href="/" class="btn btn-sm btn-outline-success">Beranda</a>
            <a href="{{ route('tentang') }}" class="btn btn-sm btn-outline-info">Tentang Kami</a>
            <a href="{{ route('kontak') }}" class="btn btn-sm btn-outline-warning">Kontak</a>
            <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-sm btn-outline-primary">Daftar</a>
        @endauth
    </div>
</nav>
<div class="container py-5">
    <h2 class="text-2xl font-bold mb-4">Tentang Kasih Kita</h2>
    <p class="text-gray-700">Kasih Kita adalah platform donasi yang membantu menyalurkan kebaikan kepada mereka yang membutuhkan dengan transparan dan terpercaya.</p>
</div>
@endsection
