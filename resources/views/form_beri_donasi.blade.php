@extends('layouts.app')

@section('title', 'Donasi Sekarang')

@section('content')
<div class="container py-5 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-2 text-gray-800">Donasi untuk: {{ $donasi->judul }}</h2>
    <p class="text-gray-600 mb-1">Target: <strong>Rp{{ number_format($donasi->target, 0, ',', '.') }}</strong></p>
    <p class="text-gray-600 mb-4 italic">{{ $donasi->keterangan }}</p>

    <form method="POST" action="{{ route('donasi.beri', $donasi->id) }}">
        @csrf
        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-semibold mb-1">Jumlah Donasi (Rp)</label>
            <input type="number" name="jumlah" id="jumlah" class="w-full border border-gray-300 px-4 py-2 rounded" required min="1000">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
            Lanjut ke Pembayaran
        </button>
    </form>
</div>
@endsection
