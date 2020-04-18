<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class Setoran extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $collector = User::findOrFail($this->collector_id);
        return [
            'id' => $this->id,
            'collector_id' => $this->collector_id,
            'collector' => $collector->name,
            'lokasi' => $collector->lokasi ? $collector->lokasi->lokasi : 'kosong',
            'jumlah' => $this->jumlah,
            'tanggal' => $this->tanggal,
        ];
    }
}
