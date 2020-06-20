<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'latitude',
        'longitude',
        'rooms',
        'beds',
        'bathrooms',
        'photo',
        'mq',
        'address',
        'visible'
    ];

// USER
    public function user()
    {
        return $this->belongsTo('App\User');
    }

// MESSAGES
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

// SERVICE
    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

// PHOTO
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

// PROMOTION
    public function promotions()
    {
        return $this->belongsToMany('App\Promotion');
    }

}
