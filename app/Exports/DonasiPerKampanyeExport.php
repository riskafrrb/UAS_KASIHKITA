<?php

namespace App\Exports;

use App\Models\Donasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DonasiPerKampanyeExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Donasi::withSum('transaksiDonasi as total_donasi', 'jumlah')
            ->get(['judul'])
            ->map(function ($item) {
                return [
                    'judul' => $item->judul,
                    'total_donasi' => $item->total_donasi ?? 0,
                ];
            });
    }

    public function headings(): array
    {
        return ["Judul Kampanye", "Total Donasi Masuk"];
    }
}
