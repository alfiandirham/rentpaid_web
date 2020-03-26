<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $fillable = [
        'lokasi', 'lat', 'long', 'provinsi', 'kab',
        'kec', 'kel', 'user_id', 'status',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tenant(){
        return $this->hasMany('App\Tenant');
    }
}
