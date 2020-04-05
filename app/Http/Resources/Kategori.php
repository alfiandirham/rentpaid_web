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
            'nama' => $this->nama,
            'kode' => $this->kode,
            'tarif' => ($this->tarif) ? ($this->tarif->bop 
                            + $this->tarif->barang 
                            + $this->tarif->listrik 
                            + $this->tarif->sampah 
                            + $this->tarif->air) : ''
        ];
    }
}
