<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrExp extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $detail = json_decode($this->detail);
        return [
            'id' => $this->id,
            'penyewa' => $this->tenant->penyewa->nama,
            'lokasi' => 'Tenant '.$this->tenant->kode.', '.$this->tenant->lokasi->lokasi,
            'tanggal' =>$this->tanggal,
            'collector' => $this->user->name,
            'bop' => $detail->bop ?? 0,
            'air' => $detail->air ?? 0,
            'listrik' => $detail->listrik ?? 0,
            'barang' => $detail->barang ?? 0,
            'sampah' => $detail->sampah ?? 0,
            'setoran' => $this->dibayar
        ];
    }
}
