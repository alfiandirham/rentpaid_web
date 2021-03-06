<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'nohp', 'status', 'ktp', 'photo','type', 'lokasi_id', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function location() {
        return $this->hasMany('App\Lokasi');
    }

    public function penyewa() {
        return $this->hasMany('App\Penyewa');
    }

    public function transaksi() {
        return $this->hasMany('App\Transaksi');
    }

    public function lokasi() {
        return $this->belongsTo('App\Lokasi');
    }

    public function tarif(){
        return $this->hasMany('App\Tarif');
    }

    public function kategori(){
        return $this->hasMany('App\Kategori');
    }

    public function perusahaan(){
        return $this->hasOne('App\Perusahaan');
    }
}
