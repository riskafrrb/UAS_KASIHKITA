@extends('layouts.app')

@section('title', 'Pemasukan Donasi')
@section('header', 'Pemasukan Donasi')
@section('subheader', 'Daftar donasi yang masuk ke pengajuan kamu.')

@section('content')
    @forelse ($donasis as $donasi)
        <div class="mb-6 bg-white p-5 rounded shadow">
            <h2 class="text-lg font-bold mb-2">{{ $donasi->judul }}</h2>
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
@endsection
