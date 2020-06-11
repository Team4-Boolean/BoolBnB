<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'name',
        'description',
        'path'
    ];

// MANY TO MANY CON HOUSE
    public function houses()
    {
        return $this->belongsToMany('App\House');
    }

}
