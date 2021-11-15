<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site;


Route::view('/', 'site.pages.homepage');


//Route::get('/stage/{slug}', 'Site\CategoryController@show')->name('category.show');
Route::get('/stages', 'Site\StageController@index')->name('site.stages');
Route::get('/stages', 'Site\StageController@index')->name('site.stages');
//Route::get('/location-stage/{id}', 'Site\Location_stageController@locations')->name('site.location-stage');
Route::get('/{id}/locations', 'Site\Location_stageController@locations')->name('site.locations');
Route::get('/{id}/shapes', 'Site\Location_stageController@shapes')->name('site.shapes');
Route::get('/{id}/colors', 'Site\Location_stageController@colors')->name('site.colors');
Route::get('/{id}/color-states', 'Site\Location_stageController@colorstates')->name('site.color-states');
Route::get('/{id}/disease', 'Site\Location_stageController@disease')->name('site.disease');

Auth::routes();
require 'admin.php';
