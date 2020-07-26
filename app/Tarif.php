<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $fillable = [
        'nama', 'bop', 'barang', 'listrik', 'sampah', 'air', 'permeter', 'user_id', 'lokasi_id'
    ];

    public function kategori(){
        return $this->hasMany('App\Kategori');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
