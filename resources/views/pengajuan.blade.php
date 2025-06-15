@extends('layouts.app')

@section('title', 'Pengajuan Donasi')
@section('header', 'Form Pengajuan Donasi')
@section('subheader', 'Isi formulir berikut untuk mengajukan donasi.')

@section('content')
    {{-- Flash Message --}}
    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Formulir Donasi</h2>
        <form action="{{ route('donasi.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">Nama Donatur</label>
                <input type="text" name="nama" id="nama" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Donasi</label>
                <input type="number" name="jumlah" id="jumlah" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-1">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="4" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-500"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                Ajukan Donasi
            </button>
        </form>

        <div class="mt-6 text-center">
    <a href="{{ url('/dashboard') }}" class="text-sm text-blue-600 hover:underline">← Kembali ke Beranda</a>
</div>

    </div>
@endsection
