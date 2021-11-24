<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Location;
use App\Stage;
use App\Shape;
use App\Color;
use App\ColorState;
use App\Disease;



class Location_stageController extends Controller
{
    
    public function locations($stage_id){
        
        $locations = Disease::where('stage_id', $stage_id)->groupBy('location_id')->distinct()->get();
        return view('site.pages.locations')->with('locations',$locations);
    }   

    public function shapes($location_id){   
        $shapes = Disease::where('location_id', $location_id)->groupBy('shape_id')->distinct()->get();
        return view('site.pages.shapes')->with('shapes',$shapes);
    }   

    public function colors($shape_id){
        $colors = Disease::where('shape_id', $shape_id)->groupBy('color_id')->distinct()->get();
        return view('site.pages.colors')->with('colors',$colors);   
    } 

    public function colorstates($color_id){
        $colorstates = Disease::where('color_id', $color_id)->groupBy('color_state_id')->distinct()->get();
        return view('site.pages.color-state')->with('colorstates',$colorstates);
    } 

    public function diseases($colorstate_id){ 
        $diseases = Disease::where('color_state_id', $colorstate_id)->groupBy('disease_detail_id')->distinct()->get();
        return view('site.pages.diseases')->with('diseases',$diseases);
    }  

}
