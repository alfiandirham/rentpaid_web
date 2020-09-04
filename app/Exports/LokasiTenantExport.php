<?php

namespace App\Exports;

use App\Http\Resources\LocTenExp;
use App\Tenant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LokasiTenantExport implements FromCollection, WithHeadings
{
    protected $lokasi_id;
    public function __construct($lokasi_id)
    {
        $this->lokasi_id = $lokasi_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return LocTenExp::collection(Tenant::with('penyewa')->where('lokasi_id', $this->lokasi_id)->get());
    }

    public function headings(): array
    {
        return [
            'No Kartu', 'Nama Penyewa'
        ];
    }
}
