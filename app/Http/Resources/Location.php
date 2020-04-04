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
            'lat' => $this->lat, 
            'long' => $this->long, 
            'alamat' => $this->alamat, 
            'user_id' => $this->user_id, 
            'owner' => $this->user->name, 
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
