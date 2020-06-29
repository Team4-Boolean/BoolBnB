<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'page_id',
        'ip_address'
    ];

    public function house()
    {
        return $this->belongsTo('App\House');
    }
}
