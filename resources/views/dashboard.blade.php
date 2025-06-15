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

@endsection
