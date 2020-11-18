<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Transaksi extends JsonResource
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
        $tunggakan = 0;
        foreach ($detail as $data) {
            $tunggakan += $data;
        }
        return [
            'id' => $this->id,
            'penyewa' => $this->penyewa->nama,
            'status' => $this->status,
            'lokasi' => 'Tenant '.$this->tenant->kode.', '.$this->tenant->lokasi->lokasi,
            'detail' => $detail,
            'tanggal' =>$this->tanggal,
            'collector' => $this->user->name,
            'setoran' => $this->dibayar,
            'sisa' => $this->sisa,
            'tunggakan' => $tunggakan
        ];
    }
}
