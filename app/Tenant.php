<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'kategori', 'nomor', 'harga', 'status', 'lokasi_id'
    ];

    public function user(){
        return $this->hasOne('App\User');
    }

    public function lokasi(){
        return $this->belongsTo('App\Lokasi');
    }
}
