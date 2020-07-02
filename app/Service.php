<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'service_icon'
    ];

// MANY TO MANY CON HOUSE
    public function houses()
    {
        return $this->belongsToMany('App\House');
    }
}
