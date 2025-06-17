<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KategoriDonasiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('donasis')
            ->join('transaksi_donasis', 'donasis.id', '=', 'transaksi_donasis.donasi_id')
            ->select('donasis.kategori', DB::raw('SUM(transaksi_donasis.jumlah) as total'))
            ->groupBy('donasis.kategori')
            ->get();
    }

    public function headings(): array
    {
        return ['Kategori', 'Total Donasi (Rp)'];
    }
}
