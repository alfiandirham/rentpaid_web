<?php

namespace App\Exports;

use App\Setoran;
use App\Http\Resources\StExp as St;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SetoranExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return St::collection(Setoran::latest()->get());
    }

    public function headings(): array
    {
        return [
            'Tanggal', 'Kolektor', 'Lokasi', 'Jumlah Setoran'
        ];
    }
}
