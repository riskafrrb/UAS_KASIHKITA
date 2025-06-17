@extends('layouts.app')

@section('title', 'Edit Pengajuan Donasi')
@section('header', 'Edit Pengajuan Donasi')
@section('subheader', 'Perbarui informasi pengajuan donasi kamu di sini.')

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
                <label for="judul" class="block text-sm font-semibold text-gray-700">Judul Donasi</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $donasi->judul) }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="penerima" class="block text-sm font-semibold text-gray-700">Nama Penerima</label>
                <input type="text" name="penerima" id="penerima" value="{{ old('penerima', $donasi->penerima) }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="kategori" class="block text-sm font-semibold text-gray-700">Kategori</label>
                <select name="kategori" id="kategori" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach (['Bencana Alam', 'Pendidikan', 'Kesehatan', 'Sosial', 'Lainnya'] as $kategori)
                        <option value="{{ $kategori }}" {{ old('kategori', $donasi->kategori) === $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="target" class="block text-sm font-semibold text-gray-700">Target Donasi</label>
                <input type="number" name="target" id="target" value="{{ old('target', $donasi->target) }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="rekening" class="block text-sm font-semibold text-gray-700">No. Rekening</label>
                <input type="text" name="rekening" id="rekening" value="{{ old('rekening', $donasi->rekening) }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="bank" class="block text-sm font-semibold text-gray-700">Bank</label>
                <input type="text" name="bank" id="bank" value="{{ old('bank', $donasi->bank) }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="kontak" class="block text-sm font-semibold text-gray-700">Kontak (WA/Email)</label>
                <input type="text" name="kontak" id="kontak" value="{{ old('kontak', $donasi->kontak) }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="keterangan" class="block text-sm font-semibold text-gray-700">Keterangan (Opsional)</label>
                <textarea name="keterangan" id="keterangan" rows="4" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('keterangan', $donasi->keterangan) }}</textarea>
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
