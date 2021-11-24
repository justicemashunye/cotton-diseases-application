<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DiseaseDetail extends Model
{

    protected $fillable = ['name','description','symptoms','mode_of_transmission','control','user_id'];

    public function diseases()
    {
        return $this->hasMany(Disease::class);
    }

    
}
