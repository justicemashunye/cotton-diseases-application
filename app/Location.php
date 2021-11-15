<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = 'locations';

    protected $fillable = [
        'name','description','image','stage_id'
    ];
    /*
    public function stages()
    {
        return $this->belongsToMany('App\Stage');
    }
    */

    protected $casts = [
        'stage_id'  =>  'integer',
    ];



      public function diseases()
    {
        return $this->hasMany(Disease::class);
    }

   
}
