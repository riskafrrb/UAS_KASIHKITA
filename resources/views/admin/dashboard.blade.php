@extends('layouts.app')

@section('title', 'Dashboard Admin - Kasih Kita')

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
    <h2 class="mb-4">Dashboard Admin</h2>
    <p>Selamat datang di halaman dashboard admin. Di sini Anda bisa mengelola pengajuan donasi, memantau pemasukan, dan melihat riwayat aktivitas.</p>

    {{-- Tambahkan fitur admin lainnya di sini --}}
</div>
@endsection
