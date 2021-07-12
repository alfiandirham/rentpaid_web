<?php

namespace App\Exports;

use App\TransactionYear;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenYearExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (\Gate::allows('isAdmin')) {
            if ($q = \Request::get('q')) {
                return TransactionYear::where('lokasi_id', \Auth::user()->lokasi_id)->where('year', $q)->orderBy('year', 'desc')->orderBy('month', 'asc')->get(['month', 'year', 'totalbayar', 'totaltunggak', 'totaltenan']);
            }
            return TransactionYear::where('lokasi_id', \Auth::user()->lokasi_id)->orderBy('year', 'desc')->orderBy('month', 'asc')->get(['month', 'year', 'totalbayar', 'totaltunggak', 'totaltenan']);
        }
        if (\Gate::allows('isOwner')) {
            if ($q = \Request::get('q')) {
                return TransactionYear::where('owner_id', \Auth::user()->id)->where('year', $q)->orderBy('year', 'desc')->orderBy('month', 'asc')->get(['month', 'year', 'totalbayar', 'totaltunggak', 'totaltenan']);
            }
            return TransactionYear::where('owner_id', \Auth::user()->id)->orderBy('year', 'desc')->orderBy('month', 'asc')->get(['month', 'year', 'totalbayar', 'totaltunggak', 'totaltenan']);
        }
        return TransactionYear::orderBy('year', 'desc')->orderBy('month', 'asc')->get(['month', 'year', 'totalbayar', 'totaltunggak', 'totaltenan']);
    }

    public function headings(): array
    {
        return [
            'Bulan', 'Tahun', 'Total Bayar', 'Total Tunggakan', 'Total Tenan Disewa'
        ];
    }
}
