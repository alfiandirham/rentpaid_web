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
            "kategori" => $this->kategori,
            "nomor" => $this->nomor,
            "harga" => $this->harga,
            "status" => $this->status,
            "user_id" => $this->user_id,
            "penyewa" => ($this->user) ? $this->user->name : 'kosong',
            "lokasi" => $this->lokasi->lokasi,
            "created_at" => (string) $this->created_at,
            "updated_at" => (string) $this->updated_at
        ];
    }
}
