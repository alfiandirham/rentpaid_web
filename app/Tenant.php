<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'kategori', 'nomor', 'harga', 'status', 'lokasi_id', 'user_id'
    ];

    public function user(){
        return $this->belongsto('App\User');
    }

    public function lokasi(){
        return $this->belongsTo('App\Lokasi');
    }
}
