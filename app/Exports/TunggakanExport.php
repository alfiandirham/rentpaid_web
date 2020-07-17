<?php

namespace App\Exports;

use App\Transaksi;
use App\Http\Resources\TrExp as Tr;
use Maatwebsite\Excel\Concerns\FromCollection;

class TunggakanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tr::collection(Transaksi::where('status', 'menunggak')->latest()->get());
    }
}
