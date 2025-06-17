<?php

use App\Http\Controllers\DonasiController;
use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Tambahan
// Admin mengelola donasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/pengajuan', [DonasiController::class, 'adminPengajuan'])->name('admin.pengajuan');
    Route::put('/admin/pengajuan/{donasi}/status', [DonasiController::class, 'ubahStatus'])->name('admin.ubah_status');
});

// Beranda umum
Route::get('/', function () {
    $donasis = Donasi::where('status', 'Disetujui')->orderBy('created_at', 'desc')->get();
    return view('welcome', compact('donasis'));
});


// Redirect berdasarkan role (admin atau user)
Route::middleware(['auth', 'verified'])->get('/redirect', function () {
    $role = Auth::user()->role;
    return $role === 'admin'
        ? redirect('/admin')
        : redirect('/dashboard');
})->name('redirect');

Route::get('/donasi/{id}/bayar', [DonasiController::class, 'bayar'])->name('donasi.bayar')->middleware('auth');

// Dashboard untuk user biasa (dengan donasi yang disetujui)
Route::middleware(['auth', 'verified'])->get('/dashboard', [DonasiController::class, 'dashboard'])->name('dashboard');


// Dashboard untuk admin
Route::middleware(['auth', 'verified'])->get('/admin', function () {
    return view('admin.dashboard'); // ⬅️ ini memanggil VIEW, bukan controller
})->name('admin.dashboard');

// Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Langsung ke file pemasukan.blade.php
    Route::get('/pemasukan', [DonasiController::class, 'pemasukan'])->name('pemasukan');

});

// Halaman form pengajuan donasi
Route::get('/pengajuan', [DonasiController::class, 'index'])->name('pengajuan');

// Simpan donasi (form submit)
Route::post('/donasi/store', [DonasiController::class, 'store'])->name('donasi.store');

Route::get('/riwayat', [DonasiController::class, 'riwayat'])->middleware('auth')->name('riwayat');


// Edit dan update donasi
Route::get('/donasi/{donasi}/edit', [DonasiController::class, 'edit'])->name('donasi.edit');
Route::put('/donasi/{donasi}', [DonasiController::class, 'update'])->name('donasi.update');

// Hapus donasi
Route::delete('/donasi/{donasi}', [DonasiController::class, 'destroy'])->name('donasi.destroy');

// Menampilkan form donasi dari pendonasi
Route::middleware('auth')->get('/donasi/{id}/form', [DonasiController::class, 'formDonasi'])->name('donasi.form');

// Proses donasi dari pendonasi
Route::middleware('auth')->post('/donasi/{id}/beri', [DonasiController::class, 'beriDonasi'])->name('donasi.beri');

Route::post('/donasi/{id}/beri', [DonasiController::class, 'beriDonasi'])->name('donasi.beri');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/riwayat', [DonasiController::class, 'adminRiwayat'])->name('admin.riwayat');
});

// 🔽 Route untuk menyimpan pengajuan donasi
Route::post('/pengajuan', [DonasiController::class, 'store'])->name('pengajuan.store');




// Pastikan login controller diarahkan jika dibutuhkan manual (opsional)
require __DIR__.'/auth.php';
