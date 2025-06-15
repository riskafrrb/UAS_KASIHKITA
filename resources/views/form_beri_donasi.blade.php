@extends('layouts.app')

@section('title', 'Donasi Sekarang')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Donasi untuk: {{ $donasi->nama }}</h2>

    <form method="POST" action="{{ route('donasi.beri', $donasi->id) }}">
        @csrf
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Donasi</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required min="1">
        </div>

        <button type="submit" class="btn btn-primary">Kirim Donasi</button>
    </form>
</div>
@endsection
