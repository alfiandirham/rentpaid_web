<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'kategori_id', 'nomor', 'status', 'lokasi_id', 'penyewa_id'
    ];

    public function penyewa(){
        return $this->belongsTo('App\Penyewa');
    }

    public function kategori(){
        return $this->belongsTo('App\Kategori');
    }

    public function lokasi(){
        return $this->belongsTo('App\Lokasi');
    }
}
