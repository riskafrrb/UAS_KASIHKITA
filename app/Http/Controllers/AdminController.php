<?php

namespace App\Http\Controllers;
 use Illuminate\Support\Facades\DB;
use App\Exports\KategoriDonasiExport;
use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\TransaksiDonasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DonasiPerKampanyeExport;

class AdminController extends Controller
{
    public function dashboard()
{
    // Ambil semua donasi disetujui, lalu kelompokkan berdasarkan kategori
    $donasiKategori = \App\Models\Donasi::where('status', 'Disetujui')
        ->selectRaw('kategori, COUNT(*) as jumlah')
        ->groupBy('kategori')
        ->get();

    // Siapkan data untuk Chart.js
    $labels = $donasiKategori->pluck('kategori');
    $data = $donasiKategori->pluck('jumlah');

    return view('admin.dashboard', compact('labels', 'data'));
}




    public function pengajuan()
    {
        $donasis = Donasi::orderByDesc('created_at')->get();
        return view('admin.pengajuan', compact('donasis'));
    }

    public function riwayat()
    {
        $donasis = Donasi::with('transaksiDonasi.user')->get();
        return view('admin.riwayat', compact('donasis'));
    }

    public function ubahStatus(Request $request, $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->status = $request->status;
        $donasi->updated_at = now();
        $donasi->save();

        return back()->with('success', 'Status donasi berhasil diubah.');
    }

public function exportPDF()
{
    // Ambil total donasi per kategori
    $data = DB::table('donasis')
        ->join('transaksi_donasis', 'donasis.id', '=', 'transaksi_donasis.donasi_id')
        ->select('donasis.kategori', DB::raw('SUM(transaksi_donasis.jumlah) as total'))
        ->groupBy('donasis.kategori')
        ->get();

    $pdf = Pdf::loadView('admin.pdf_kategori', compact('data'));
    return $pdf->download('distribusi_kategori_donasi.pdf');
}

public function exportExcel()
{
    return Excel::download(new KategoriDonasiExport, 'distribusi_kategori_donasi.xlsx');
}

    public function pemasukan()
{
    $donasis = Donasi::withSum('transaksiDonasi as total_donasi', 'jumlah')
                    ->where('status', 'Disetujui')
                    ->get();

    $labels = $donasis->pluck('judul')->toArray();
    $data = $donasis->pluck('total_donasi')->toArray();

    return view('admin.pemasukan', compact('donasis', 'labels', 'data'));
}

public function exportPemasukanPDF()
{
    $donasis = Donasi::withSum('transaksiDonasi as total_donasi', 'jumlah')
                     ->where('status', 'Disetujui')
                     ->get();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pemasukan_pdf', compact('donasis'));
    return $pdf->download('laporan_pemasukan.pdf');
}

}
