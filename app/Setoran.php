<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $fillable = [
        'collector_id', 'staff_id', 'tanggal', 'jumlah' 
    ];
}