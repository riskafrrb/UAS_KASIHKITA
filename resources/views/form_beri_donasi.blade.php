@extends('layouts.app')

@section('title', 'Donasi Sekarang')

@section('content')
@php
    $total_terkumpul = $donasi->transaksis()->sum('jumlah');
    $sisa_donasi = $donasi->target - $total_terkumpul;
@endphp

<div class="container py-5 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-2 text-gray-800">Donasi untuk: {{ $donasi->judul }}</h2>

    <div class="mb-4 text-sm text-gray-700 space-y-1">
        <p><strong>Nama Penerima:</strong> {{ $donasi->nama_penerima }}</p>
        <p><strong>Kategori:</strong> {{ $donasi->kategori }}</p>
        <p><strong>Target Donasi:</strong> Rp{{ number_format($donasi->target, 0, ',', '.') }}</p>
        <p><strong>Terkumpul:</strong> Rp{{ number_format($total_terkumpul, 0, ',', '.') }}</p>
        <p><strong>Sisa Kebutuhan:</strong> Rp{{ number_format($sisa_donasi, 0, ',', '.') }}</p>
        <p><strong>Keterangan:</strong> {{ $donasi->keterangan }}</p>
    </div>

    @if ($total_terkumpul >= $donasi->target)
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4 text-center font-semibold">
            Target donasi telah terpenuhi. Terima kasih atas partisipasinya! 🙏
        </div>
    @else
        <form method="POST" action="{{ route('donasi.beri', $donasi->id) }}" id="donasiForm">
            @csrf
            <div class="mb-4">
                <label for="jumlah" class="block text-sm font-semibold mb-1">Jumlah Donasi (Rp)</label>
                <input type="number" name="jumlah" id="jumlah" class="w-full border border-gray-300 px-4 py-2 rounded" required min="1000" max="{{ $sisa_donasi }}" placeholder="Minimal Rp1.000">
                <small id="errorJumlah" class="text-red-600 font-medium hidden mt-1">Jumlah melebihi sisa donasi.</small>
            </div>

            <button id="submitBtn" type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                Lanjut ke Pembayaran
            </button>
        </form>
    @endif
</div>

{{-- Validasi client-side --}}
<script>
    const inputJumlah = document.getElementById('jumlah');
    const errorJumlah = document.getElementById('errorJumlah');
    const submitBtn = document.getElementById('submitBtn');
    const sisaDonasi = {{ $sisa_donasi }};

    inputJumlah.addEventListener('input', function () {
        const value = parseInt(this.value);

        if (value > sisaDonasi) {
            errorJumlah.classList.remove('hidden');
            inputJumlah.classList.add('border-red-500');
            submitBtn.disabled = true;
            submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
            submitBtn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        } else {
            errorJumlah.classList.add('hidden');
            inputJumlah.classList.remove('border-red-500');
            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
            submitBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
        }
    });
</script>
@endsection
