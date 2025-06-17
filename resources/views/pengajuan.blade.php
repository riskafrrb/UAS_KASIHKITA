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

            {{-- Judul Donasi --}}
            <div class="mb-4">
                <label for="judul" class="block text-sm font-semibold text-gray-700 mb-1">Judul Donasi</label>
                <input type="text" name="judul" id="judul" class="w-full border border-gray-300 px-4 py-2 rounded" required>
            </div>

            {{-- Nama Penerima --}}
            <div class="mb-4">
                <label for="penerima" class="block text-sm font-semibold text-gray-700 mb-1">Nama Penerima Donasi</label>
                <input type="text" name="penerima" id="penerima" class="w-full border border-gray-300 px-4 py-2 rounded" required>
            </div>
            
            {{-- Kontak --}}
            <div class="mb-4">
                <label for="kontak" class="block text-sm font-semibold text-gray-700 mb-1">Kontak Pengaju Donasi</label>
                <input type="text" name="kontak" id="kontak" class="w-full border border-gray-300 px-4 py-2 rounded" required>
            </div>

            {{-- Kategori Donasi --}}
            <div class="mb-4">
                <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-1">Kategori Donasi</label>
                <select name="kategori" id="kategori" class="w-full border border-gray-300 px-4 py-2 rounded" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Bencana Alam">Bencana Alam</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Sosial">Sosial</option>
                    <option value="Keagamaan">Keagamaan</option>
                </select>
            </div>

            {{-- Target Donasi --}}
            <div class="mb-4">
                <label for="target" class="block text-sm font-semibold text-gray-700 mb-1">Target Donasi (Rp)</label>
                <input type="number" name="target" id="target" class="w-full border border-gray-300 px-4 py-2 rounded" required>
            </div>

            {{-- No. Rekening --}}
            <div class="mb-4">
                <label for="rekening" class="block text-sm font-semibold text-gray-700 mb-1">Nomor Rekening</label>
                <input type="text" name="rekening" id="rekening" class="w-full border border-gray-300 px-4 py-2 rounded" required>
            </div>

            {{-- Bank --}}
            <div class="mb-4">
                <label for="bank" class="block text-sm font-semibold text-gray-700 mb-1">Bank</label>
                <input type="text" name="bank" id="bank" class="w-full border border-gray-300 px-4 py-2 rounded" required>
            </div>


            {{-- Keterangan --}}
            <div class="mb-6">
                <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-1">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="4" class="w-full border border-gray-300 px-4 py-2 rounded"></textarea>
            </div>

            {{-- Submit --}}
            <button type="submit" onclick="return konfirmasiSubmit()" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
    Ajukan Donasi
</button>

        </form>
        <script>
    function konfirmasiSubmit() {
        const yakin = confirm("Apakah data yang Anda masukkan sudah benar?\nKlik OK untuk mengajukan donasi.");
        if (yakin) {
            alert("✅ Pengajuan sedang diproses. Anda akan diarahkan ke halaman riwayat.");
            return true; // lanjut submit form
        } else {
            return false; // batalkan submit
        }
    }
</script>


        <div class="mt-6 text-center">
            <a href="{{ url('/dashboard') }}" class="text-sm text-blue-600 hover:underline">← Kembali ke Beranda</a>
        </div>
    </div>
@endsection
