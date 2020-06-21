<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'house_id',
        'name',
        'description',
        'path'
    ];

// ONE TO MANY CON HOUSE
    public function house()
    {
        return $this->belongsTo('App\House');
    }

}
