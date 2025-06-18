@extends('layouts.app')

@section('title', 'Dashboard Admin - Kasih Kita')

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

<div class="container py-5 text-white bg-gray-900">
    <h2 class="mb-4">Dashboard Admin</h2>
    <p>Selamat datang di halaman dashboard admin. Di sini Anda bisa mengelola pengajuan donasi, memantau pemasukan, dan melihat riwayat aktivitas.</p>

    <h4 class="mt-5">Diagram Distribusi Kategori Donasi</h4>
    <div style="max-width: 500px; margin: auto;">
    <canvas id="donasiChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('donasiChart').getContext('2d');
    const donasiChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Donasi per Kategori',
                data: {!! json_encode($data) !!},
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a',
                    '#36b9cc',
                    '#f6c23e',
                    '#e74a3b',
                    '#858796'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: 'white' // Ubah warna label legend jadi putih
                    }
                },
                title: {
                    display: true,
                    text: 'Distribusi Kategori Donasi',
                    color: 'white' // Ubah warna judul jadi putih
                }
            }
        }
    });
</script>

@endsection
