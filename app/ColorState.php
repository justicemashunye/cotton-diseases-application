<?php

namespace App;
use App\Disease;

use Illuminate\Database\Eloquent\Model;

class ColorState extends Model
{
    //
    protected $table = 'color_states';

    protected $fillable = [
        'description','image'
    ];

    public function diseases()
    {
        return $this->hasMany(Disease::class);
    }
}
