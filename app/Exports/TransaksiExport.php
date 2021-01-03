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
        return Tr::collection(Transaksi::where('owner_id', \Auth::user()->id)
        ->orWhere('lokasi_id', \Auth::user()->lokasi_id)
        ->where('dibayar', '>=', 0)->latest()->take(1000)->get());
    }

    public function headings(): array
    {
        return [
            'Id', 'Penyewa', 'Nama Lokasi', 'Tanggal', 'Kolektor', 'BOP', 'Air', 'Listrik', 'Barang Masuk', 'Sampah', 'Jumlah Setoran'
        ];
    }
}
