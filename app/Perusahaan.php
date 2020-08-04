<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $fillable = [
        'name', 'alamat', 'photo', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
