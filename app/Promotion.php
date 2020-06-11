<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'name',
        'price',
        'start',
        'end'
    ];

// MANY TO MANY CON HOUSE
    public function houses()
    {
        return $this->belongsToMany('App\House');
    }

}
