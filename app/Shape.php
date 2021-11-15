<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shape extends Model
{
    //

    protected $table = 'shapes';

    protected $fillable = [
        'description','image'
    ];

    public function locations()
    {
        return $this->belongsToMany('App\Location');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Color');
    }

}
