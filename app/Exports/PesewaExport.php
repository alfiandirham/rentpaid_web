<?php

namespace App\Exports;

use App\Lokasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Resources\TrPesewa as TenantCollections;

class PesewaExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (\Gate::allows('isAdmin')) {
            $id = \Auth::user()->lokasi_id;
            return TenantCollections::collection(Lokasi::where(['status' => true, 'id' => $id])->latest()->get());
        }
        if (\Gate::allows('isOwner')) {
            return TenantCollections::collection(\Auth::user()->location()->where('status', true)->latest()->get());
        }
        if (\Gate::allows('isAuthor')) {
            return TenantCollections::collection(Lokasi::latest()->get());
        }
    }

    public function headings(): array
    {
        return [
            'Lokasi', 'Jumlah Tenant'
        ];
    }
}
