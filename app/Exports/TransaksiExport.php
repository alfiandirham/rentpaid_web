<?php

namespace App\Exports;

use App\Transaksi;
use App\Http\Resources\TrExp as Tr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tr::collection(Transaksi::where('status', '<>', 'menunggak')->latest()->get());
    }

    public function headings(): array
    {
        return [
            'Id', 'Penyewa', 'Nama Lokasi', 'Tanggal', 'Kolektor', 'Jumlah Setoran'
        ];
    }
}
