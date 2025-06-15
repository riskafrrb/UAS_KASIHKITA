@extends('layouts.app')

@section('title', 'Edit Donasi')
@section('header', 'Edit Donasi')
@section('subheader', 'Perbarui informasi donasi kamu di sini.')

@section('content')
    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-700 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <form action="{{ route('donasi.update', $donasi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-sm font-semibold text-gray-700">Nama Donatur</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $donasi->nama) }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="jumlah" class="block text-sm font-semibold text-gray-700">Jumlah Donasi</label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $donasi->jumlah) }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="keterangan" class="block text-sm font-semibold text-gray-700">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('keterangan', $donasi->keterangan) }}</textarea>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan Perubahan
                </button>
                <a href="{{ route('riwayat') }}" class="text-sm text-blue-600 hover:underline">← Batal & Kembali</a>
            </div>
        </form>
    </div>
@endsection
