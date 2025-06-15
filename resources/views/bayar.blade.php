@extends('layouts.app')

@section('title', 'Bayar Donasi')

@section('content')
<div class="container py-5">
    <h3>Donasi untuk: {{ $donasi->nama }}</h3>
    <p>Jumlah dibutuhkan: Rp{{ number_format($donasi->jumlah, 0, ',', '.') }}</p>

    {{-- Form pembayaran simulasi --}}
    <form method="POST" action="#">
        @csrf
        <div class="mb-3">
            <label>Jumlah yang ingin didonasikan</label>
            <input type="number" class="form-control" name="jumlah_donasi" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Kirim Donasi</button>
    </form>
</div>
@endsection
