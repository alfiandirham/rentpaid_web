<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Kategori extends JsonResource
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
            'nama' => $this->nama,
            'kode' => $this->kode,
            'tarif_id' => $this->tarif_id,
            'tarif' => ($this->tarif) ? ($this->tarif->bop
                            + $this->tarif->permeter
                            + ($this->tarif->bop * 0.1) 
                            + $this->tarif->barang 
                            + $this->tarif->listrik 
                            + $this->tarif->sampah 
                            + $this->tarif->air) : ''
        ];
    }
}
