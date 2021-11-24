<?php

namespace App;
use App\Disease;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    protected $table = 'colors';

   
    protected $fillable = ['name','image'];

    public function diseases()
    {
        return $this->hasMany(Disease::class);
    }

}
