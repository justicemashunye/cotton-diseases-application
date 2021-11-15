<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stage extends Model
{
    
    protected $table = 'stages';

    protected $fillable = [
        'name', 'slug', 'featured', 'menu', 'image'
    ];

    protected $casts = [
        'featured'  =>  'boolean',
        'menu'      =>  'boolean'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function parent()
    {
        return $this->belongsTo(Stage::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Stage::class, 'parent_id');
    }

    /*
    public function locations()
    {
        return $this->belongsToMany('App\Location');
    }
    */

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
   
}

