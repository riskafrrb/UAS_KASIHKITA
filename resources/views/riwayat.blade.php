@extends('layouts.app')

@section('title', 'Riwayat Donasi')
@section('header', 'Riwayat Donasi')
@section('subheader', 'Daftar donasi yang telah kamu ajukan.')

@section('content')
    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-700 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Dropdown Pilihan Riwayat --}}
    <div class="mb-4">
        <label for="jenis-riwayat" class="block mb-1 text-sm font-medium text-gray-700">Pilih Jenis Riwayat:</label>
        <select id="jenis-riwayat" onchange="tampilkanRiwayat()" class="w-full max-w-xs px-4 py-2 border rounded">
            <option value="pengajuan">Riwayat Pengajuan Donasi</option>
            <option value="berdonasi">Riwayat Berdonasi</option>
        </select>
    </div>

    {{-- Riwayat Pengajuan --}}
    <div id="riwayat-pengajuan">
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <table class="min-w-full text-sm text-left text-gray-700 border">
                <thead class="bg-blue-50 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="p-3 border">Nama</th>
                        <th class="p-3 border">Jumlah</th>
                        <th class="p-3 border">Keterangan</th>
                        <th class="p-3 border">Status</th>
                        <th class="p-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($donasi as $d)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border">{{ $d->nama }}</td>
                            <td class="p-3 border">Rp{{ number_format($d->jumlah, 0, ',', '.') }}</td>
                            <td class="p-3 border">{{ $d->keterangan }}</td>
                            <td class="p-3 border">
                                @if ($d->status == 'Disetujui')
                                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded">Disetujui</span>
                                @elseif ($d->status == 'Ditolak')
                                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded">Ditolak</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded">Pending</span>
                                @endif
                            </td>
                            <td class="p-3 border">
                                @if ($d->status === 'Pending')
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('donasi.edit', $d->id) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                        <form action="{{ route('donasi.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline text-sm">Hapus</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-gray-500 text-sm italic">Tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-400 italic border">Belum ada donasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6 text-center">
                <a href="{{ url('/dashboard') }}" class="text-sm text-blue-600 hover:underline">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    {{-- Riwayat Berdonasi (Kosong dulu) --}}
    <div id="riwayat-berdonasi" class="hidden">
        <div class="bg-white p-6 rounded-xl shadow-lg text-gray-600 italic text-center border border-dashed">
            Belum ada riwayat berdonasi.
        </div>
    </div>

    <script>
        function tampilkanRiwayat() {
            const jenis = document.getElementById('jenis-riwayat').value;
            document.getElementById('riwayat-pengajuan').style.display = jenis === 'pengajuan' ? 'block' : 'none';
            document.getElementById('riwayat-berdonasi').style.display = jenis === 'berdonasi' ? 'block' : 'none';
        }
    </script>
@endsection
