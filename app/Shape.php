<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Disease;

class Shape extends Model
{
    //

    protected $table = 'shapes';

    protected $fillable = [
        'description','image'
    ];

    
    public function diseases()
    {
        return $this->hasMany(Disease::class);
    }

}
