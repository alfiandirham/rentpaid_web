<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'nama', 'kode', 'tarif_id', 'user_id', 'lokasi_id'
    ];

    public function tarif(){
        return $this->belongsTo('App\Tarif');
    }

    public function tenant(){
        return $this->hasMany('App\Tenant');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
