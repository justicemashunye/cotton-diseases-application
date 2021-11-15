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
        /*
        $locations = Disease::where('stage_id', $stage_id)->groupBy('location_id')->get(['location_id']);
        return view('site.pages.locations')->with('locations',$locations);
        
        $locations = Disease::with('locations')->where('stage_id', $stage_id)->groupBy('location_id')->get(['location_id']);
        dd($locations);
        */
        $locations = Disease::where('stage_id', $stage_id)->groupBy('location_id')->distinct()->get();
        return view('site.pages.locations')->with('locations',$locations);
    }   

    public function shapes($location_id){

        $shapes = Disease::where('location_id', $location_id)->groupBy('shape_id')->get(['shape_id']);
        return view('site.pages.shapes')->with('shapes',$shapes);       
    }  
    public function colors($shape_id){

        $colors = Color::where('shape_id', $shape_id)->get();
        return view('site.pages.colors')->with('colors',$colors);
       
    } 

    public function colorstates($color){
        $colorstates = ColorState::where('color_id', $color)->get();
        return view('site.pages.color-state')->with('colorstates',$colorstates);
    } 

    public function disease($colorstate){
        //$colorstates = ColorState::where('color_id', $color)->get();
        //return view('site.pages.color-state')->with('colorstates',$colorstates);

        $diseases = Disease::where('color_state_id', $colorstate)->get();
        $disease = $diseases[0];
        return view('site.pages.diseases')->with('disease',  $disease);
    } 

}
