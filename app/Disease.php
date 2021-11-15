<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;


class Disease extends Model
{
    
    protected $table = 'diseases';

    
    protected $fillable = ['name','description','symptoms','mode_of_transmission','control',
                        'stage_id','location_id','shape_id','color_id','color_state_id','user_id'];


   public function location()
    {
        return $this->belongsTo(Location::class);
    }

    
}