<?php

namespace App;
use App\Shape;
use App\Stage;
use App\Color;
use App\ColorState;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;


class Disease extends Model
{
    
    protected $table = 'diseases';

    
    protected $fillable = ['stage_id','location_id','shape_id','color_id','color_state_id','user_id','disease_detail_id'];


   public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function shape()
    {
        return $this->belongsTo(Shape::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function colorstate()
    {
        return $this->belongsTo('App\ColorState', 'color_state_id');
    }

    public function diseasedetail()
    {
        return $this->belongsTo('App\DiseaseDetail', 'disease_detail_id');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    
}