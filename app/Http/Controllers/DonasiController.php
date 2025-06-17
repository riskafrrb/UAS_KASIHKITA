<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Models\TransaksiDonasi;

class DonasiController extends Controller
{
    // Batasi akses untuk user login

    /**
     * Tampilkan form pengajuan donasi
     */
    public function index()
    {
        return view('pengajuan');
    }

    /**
     * Simpan donasi dari form
     */
    

    /**
     * Tampilkan riwayat donasi
     */
   public function riwayat()
{
    $userId = Auth::id(); // hanya data user yang login

    // Riwayat pengajuan donasi oleh user
    $donasi = Donasi::where('user_id', $userId)->latest()->get();

    // Riwayat user sebagai pendonasi
    $transaksi = TransaksiDonasi::where('user_id', $userId)
                    ->with('donasi')
                    ->latest()
                    ->get();

    return view('riwayat', compact('donasi', 'transaksi'));
}

    /**
     * Tampilkan form edit donasi (hanya jika status = Pending)
     */
    public function edit(Donasi $donasi)
    {
        if ($donasi->status !== 'Pending') {
            return redirect()->route('riwayat')->with('error', 'Donasi tidak dapat diedit karena sudah diproses.');
        }

        return view('edit', compact('donasi'));
    }

    /**
     * Update donasi yang diedit
     */
    public function update(Request $request, Donasi $donasi)
{
    if ($donasi->status !== 'Pending') {
        return redirect()->route('riwayat')->with('error', 'Donasi tidak dapat diperbarui karena sudah diproses.');
    }

    $request->validate([
        'judul' => 'required|string|max:255',
        'penerima' => 'required|string|max:255',
        'kategori' => 'required|string|in:Bencana Alam,Pendidikan,Kesehatan,Sosial,Lainnya',
        'target' => 'required|numeric|min:1',
        'rekening' => 'required|string|max:255',
        'bank' => 'required|string|max:100',
        'kontak' => 'required|string|max:50',
        'keterangan' => 'nullable|string',
    ]);

    $donasi->update([
        'judul' => $request->judul,
        'penerima' => $request->penerima,
        'kategori' => $request->kategori,
        'target' => $request->target,
        'rekening' => $request->rekening,
        'bank' => $request->bank,
        'kontak' => $request->kontak,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->route('riwayat')->with('success', 'Pengajuan donasi berhasil diperbarui.');
}


    /**
     * Hapus donasi (hanya jika status = Pending)
     */
    public function destroy(Donasi $donasi)
    {
        if ($donasi->status !== 'Pending') {
            return redirect()->route('riwayat')->with('error', 'Donasi tidak dapat dihapus karena sudah diproses.');
        }

        $donasi->delete();

        return redirect()->route('riwayat')->with('success', 'Donasi berhasil dihapus.');
    }

    /**
     * Halaman admin melihat semua pengajuan donasi
     */
    public function adminPengajuan()
    {
        $donasis = Donasi::orderBy('created_at', 'desc')->get();
        return view('admin.pengajuan', ['donasis' => $donasis]);
    }
    public function bayar($id)
{
    $donasi = Donasi::findOrFail($id);
    return view('bayar', compact('donasi')); // buat file bayar.blade.php nanti
}

    /**
     * Admin mengubah status donasi
     */
    public function ubahStatus(Request $request, Donasi $donasi)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak,Pending',
        ]);

        $donasi->update(['status' => $request->status]);

        return redirect()->route('admin.pengajuan')->with('success', 'Status donasi berhasil diperbarui.');
    }

public function formDonasi($id) {
    $donasi = Donasi::findOrFail($id);
    return view('form_beri_donasi', compact('donasi'));
}
public function adminRiwayat()
{
    $donasis = Donasi::with('transaksiDonasi.user')->get();

    // Hapus atau komentar dump ini setelah cek berhasil
    // foreach ($donasis as $donasi) {
    //     foreach ($donasi->transaksiDonasi as $transaksi) {
    //         dump($transaksi->user);
    //     }
    // }

    return view('admin.riwayat', compact('donasis'));
}

public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'penerima' => 'required|string|max:255',
        'kategori' => 'required|string|in:Bencana Alam,Pendidikan,Kesehatan,Sosial,Lainnya',
        'target' => 'required|numeric|min:1',
        'rekening' => 'required|string|max:255',
        'bank' => 'required|string|max:100',
        'kontak' => 'required|string|max:50',
        'keterangan' => 'nullable|string',
    ]);

    Donasi::create([
        'user_id' => Auth::id(),
        'judul' => $request->judul,
        'penerima' => $request->penerima,
        'kategori' => $request->kategori,
        'target' => $request->target,
        'rekening' => $request->rekening,
        'bank' => $request->bank,
        'kontak' => $request->kontak,
        'keterangan' => $request->keterangan,
        'status' => 'Pending',
    ]);

    return redirect()->route('riwayat')->with('success', 'Pengajuan donasi berhasil dikirim.');
}

public function dashboard()
{
    $donasis = Donasi::where('status', 'Disetujui')->latest()->get();
    return view('dashboard', compact('donasis'));
}
public function beriDonasi(Request $request, $id)
{
    $donasi = Donasi::findOrFail($id);

    $validated = $request->validate([
        'jumlah' => 'required|numeric|min:1000',
    ]);

    // Simpan transaksi donasi (bisa disesuaikan kalau pakai model TransaksiDonasi)
    TransaksiDonasi::create([
        'user_id' => auth()->id(),
        'donasi_id' => $donasi->id,
        'jumlah' => $validated['jumlah'],
    ]);

    // Redirect ke halaman pembayaran
    return view('pembayaran', [
        'donasi' => $donasi,
        'jumlah' => $validated['jumlah']
    ]);
}
public function pemasukan()
{
    $userId = Auth::id();

    // Ambil semua pengajuan donasi milik user yang login
    $donasis = Donasi::where('user_id', $userId)
        ->with(['transaksiDonasi.user']) // eager load relasi
        ->get();

    return view('pemasukan', compact('donasis'));
}


}
