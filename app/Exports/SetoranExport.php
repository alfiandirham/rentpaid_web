<?php

namespace App\Exports;

use App\Setoran;
use App\Http\Resources\StExp as St;
use Maatwebsite\Excel\Concerns\FromCollection;

class SetoranExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return St::collection(Setoran::latest()->get());
    }
}
