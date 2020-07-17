<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class StExp extends JsonResource
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
            'tanggal' => $this->tanggal,
            'collector' => $collector->name,
            'lokasi' => $collector->lokasi ? $collector->lokasi->lokasi : 'kosong',
            'jumlah' => $this->jumlah,
        ];
    }
}
