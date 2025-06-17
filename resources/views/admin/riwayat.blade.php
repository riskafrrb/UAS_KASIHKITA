@extends('layouts.app')

@section('title', 'Riwayat Donasi Admin')

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
    <h2 class="mb-4">Riwayat Donasi oleh Pendonasi</h2>

    @forelse ($donasis as $donasi)
        <div class="mb-5 p-4 border rounded-lg shadow-sm bg-white">
            <h4 class="font-semibold text-lg mb-2">Kampanye: {{ $donasi->nama }}</h4>
            <p class="text-sm text-gray-500 mb-3">Keterangan: {{ $donasi->keterangan }}</p>

            @if ($donasi->transaksiDonasi->isEmpty())
                <p class="text-gray-400 italic">Belum ada yang berdonasi untuk kampanye ini.</p>
            @else
                <table class="min-w-full text-sm text-left text-gray-700 border">
                    <thead class="bg-blue-50 text-gray-800 uppercase text-xs">
                        <tr>
                            <th class="p-3 border">Nama Pendonasi</th>
                            <th class="p-3 border">Jumlah</th>
                            <th class="p-3 border">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donasi->transaksiDonasi as $transaksi)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border">{{ $transaksi->user->name ?? 'Akun Tidak Ditemukan' }}</td>
                                <td class="p-3 border">Rp{{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                                <td class="p-3 border">{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @empty
        <p class="text-gray-500">Belum ada data kampanye donasi.</p>
    @endforelse
</div>
@endsection
