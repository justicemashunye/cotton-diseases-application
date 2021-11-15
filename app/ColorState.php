<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorState extends Model
{
    //
    protected $table = 'color_states';

    protected $fillable = [
        'description','image'
    ];

    public function colors()
    {
        return $this->belongsToMany('App\Color');
    }
}
