<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Location extends JsonResource
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
            'lokasi' => $this->lokasi, 
            'luas' => $this->luas, 
            'kode' => $this->kode, 
            'kecamatan' => $this->kecamatan, 
            'desa' => $this->desa, 
            'alamat' => $this->alamat, 
            'user_id' => $this->user_id, 
            'owner' => $this->user->name, 
            'tenan' => $this->tenant, 
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
