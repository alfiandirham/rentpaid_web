<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    protected $fillable = [
        'tenant_id', 'penyewa_id', 'status', 'dibayar', 'sisa', 'tanggal', 'user_id', 'detail', 'lokasi_id', 'owner_id', 'shift'
    ];

    protected $table = 'pendapatan';

    public function tenant()
    {
        return $this->belongsTo('App\Tenant');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function penyewa()
    {
        return $this->belongsTo('App\Penyewa');
    }
}
