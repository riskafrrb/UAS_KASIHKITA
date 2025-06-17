@extends('layouts.app')

@section('title', 'Dashboard Pengguna - Kasih Kita')

@section('content')
<nav style="background-color: #f8f9fa; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <h3 style="margin: 0; color: #0b1f47;">Halo, {{ Auth::user()->name }}</h3>
    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-info">Dashboard</a>
            <a href="{{ route('pengajuan') }}" class="btn btn-sm btn-outline-info">Pengajuan</a>
            <a href="{{ route('riwayat') }}" class="btn btn-sm btn-outline-info">Riwayat</a>
            <a href="{{ route('user.pemasukan') }}" class="btn btn-sm btn-outline-info">Pemasukan</a>
        @endauth
    </div>
</nav>

<div class="container mt-5">
    <h4 class="mb-4">Donasi yang Kamu Ajukan</h4>

    @forelse ($donasis as $donasi)
        @php
            $total_terkumpul = $donasi->transaksiDonasi->sum('jumlah');
        @endphp

        <div class="mb-6 bg-white p-5 rounded shadow border">
            <h2 class="text-lg font-bold mb-1">{{ $donasi->judul }}</h2>

            {{-- Status Donasi --}}
            @if ($total_terkumpul >= $donasi->target)
                <div class="text-green-700 bg-green-100 border border-green-300 p-2 rounded mb-3">
                    🎉 Target donasi telah terpenuhi (Rp{{ number_format($total_terkumpul, 0, ',', '.') }}/{{ number_format($donasi->target, 0, ',', '.') }})  
                    <br>💬 Dana akan segera disalurkan oleh pengelola.
                </div>
            @else
                <div class="text-yellow-700 bg-yellow-100 border border-yellow-300 p-2 rounded mb-3">
                    📊 Terkumpul Rp{{ number_format($total_terkumpul, 0, ',', '.') }} dari target Rp{{ number_format($donasi->target, 0, ',', '.') }}
                </div>
            @endif

            {{-- Tabel Donatur --}}
            @if ($donasi->transaksiDonasi->isEmpty())
                <p class="text-sm text-gray-500 italic">Belum ada donasi masuk.</p>
            @else
                <table class="w-full text-sm text-left text-gray-600 border mt-2">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">Nama Donatur</th>
                            <th class="p-2 border">Jumlah</th>
                            <th class="p-2 border">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donasi->transaksiDonasi as $transaksi)
                            <tr>
                                <td class="p-2 border">{{ $transaksi->user->name ?? 'Anonim' }}</td>
                                <td class="p-2 border">Rp{{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                                <td class="p-2 border">{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @empty
        <p class="text-center text-gray-500 italic">Kamu belum mengajukan donasi apapun.</p>
    @endforelse
</div>
@endsection
