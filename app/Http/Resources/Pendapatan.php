<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pendapatan extends JsonResource
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
            'tanggal' =>$this->tanggal,
            't_bayar' => $this->t_bayar ?? 0,
            'pendapatan' => $this->pendapatan,
            't_tunggak' => $this->t_tunggak ?? 0,
            'tunggakan' => $this->tunggakan,
        ];
    }
}
