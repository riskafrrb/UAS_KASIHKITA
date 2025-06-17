@extends('layouts.app')

@section('title', 'Pembayaran Donasi')

@section('content')
<div class="container py-5 max-w-xl mx-auto text-center">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Silakan Lakukan Pembayaran</h2>
    <p class="text-gray-700 mb-2">Jumlah yang harus dibayar:</p>
    <div class="text-3xl font-bold text-green-600 mb-4">
        Rp{{ number_format($jumlah, 0, ',', '.') }}
    </div>

    <p class="text-gray-600 mb-2">Scan QRIS di bawah ini untuk menyelesaikan donasi:</p>
    <img src="{{ asset('images/qris_sample.jpg') }}" 
         alt="QRIS Pembayaran" 
         class="w-40 mx-auto border p-2 rounded shadow-lg mb-4">

    <a href="{{ url('/dashboard') }}"
       class="inline-block bg-green-600 text-white font-semibold py-2 px-4 rounded hover:bg-green-700 transition">
        Selesai
    </a>
</div>
@endsection
