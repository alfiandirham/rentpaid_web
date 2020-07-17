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
        return [
            'id' => $this->id,
            'penyewa' => $this->tenant->penyewa->nama,
            'lokasi' => 'Tenant '.$this->tenant->kode.', '.$this->tenant->lokasi->lokasi,
            'tanggal' =>$this->tanggal,
            'collector' => $this->user->name,
            'setoran' => $this->dibayar
        ];
    }
}
