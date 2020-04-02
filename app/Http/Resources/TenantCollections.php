<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantCollections extends JsonResource
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
            'jumlah' => $this->tenant->count(),
            'disewa' => $this->tenant->where('status', false)->count(),
            'tersedia' => $this->tenant->where('status', true)->count(),
            'status' => $this->status,
            'owner' => $this->user->name,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
