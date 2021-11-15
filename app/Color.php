<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    protected $table = 'colors';

   
    protected $fillable = ['name','image'];

    public function shapes()
    {
        return $this->belongsToMany('App\Shape');
    }

}
