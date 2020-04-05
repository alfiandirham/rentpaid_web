<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tenant extends JsonResource
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
            "id" => $this->id,
            "kategori" => $this->kategori->kode,
            "nomor" => $this->nomor,
            "harga" => ($this->kategori->tarif->bop 
                            + $this->kategori->tarif->barang 
                            + $this->kategori->tarif->listrik 
                            + $this->kategori->tarif->sampah 
                            + $this->kategori->tarif->air),
            "status" => $this->status,
            "user_id" => $this->user_id,
            "penyewa" => ($this->penyewa) ? $this->penyewa->nama : 'kosong',
            "lokasi" => $this->lokasi->lokasi,
            "created_at" => (string) $this->created_at,
            "updated_at" => (string) $this->updated_at
        ];
    }
}
