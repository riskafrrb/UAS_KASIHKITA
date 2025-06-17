@extends('layouts.app')

@section('title', 'Pemasukan - Kasih Kita')

@section('content')
<nav style="background-color: #f8f9fa; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <h3 style="margin: 0; color: #0b1f47;">Halo, Admin {{ Auth::user()->name }}</h3>
    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
        @auth
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-primary">Dashboard</a>
            <a href="{{ route('admin.pengajuan') }}" class="btn btn-sm btn-outline-info">Pengajuan</a>
            <a href="{{ route('admin.riwayat') }}" class="btn btn-sm btn-outline-info">Riwayat</a>
            <a href="{{ route('pemasukan') }}" class="btn btn-sm btn-outline-info">Pemasukan</a>
        @endauth
    </div>
</nav>
<div class="container py-5">
    <h2 class="mb-4">Laporan Pemasukan per Kampanye Donasi</h2>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Judul Donasi</th>
                <th>Kategori</th>
                <th>Total Pemasukan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donasis as $index => $donasi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $donasi->judul }}</td>
                    <td>{{ $donasi->kategori }}</td>
                    <td>Rp {{ number_format($donasi->total_donasi, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="max-width: 600px; margin: auto;">
        <canvas id="chartPemasukan"></canvas>
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('pemasukan.export.pdf') }}" class="btn btn-danger btn-sm">Download PDF</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPemasukan').getContext('2d');
    const chartPemasukan = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Total Donasi (Rp)',
                data: {!! json_encode($data) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
