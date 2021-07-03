<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingpageSetting extends Model
{
    protected $table = 'landingpage_setting';
    protected $fillable = [
        'setting','value'
    ];
}
