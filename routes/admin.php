<?php




Route::group(['prefix'  =>  'admin'], function () {

Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');



Route::group(['middleware' => ['auth:admin']], function () {

    Route::get('/', function () {
        return view('admin.dashboard.index');
    })->name('admin.dashboard');

    ////////Settings
    Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
    Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');

    /////// Stages
    Route::group(['prefix'  =>   'stages'], function() {

        Route::get('/', 'Admin\StageController@index')->name('admin.stages.index');
        Route::get('/create', 'Admin\StageController@create')->name('admin.stages.create');
        Route::post('/store', 'Admin\StageController@store')->name('admin.stages.store');
        Route::get('/{id}/edit', 'Admin\StageController@edit')->name('admin.stages.edit');
        Route::post('/update', 'Admin\StageController@update')->name('admin.stages.update');
        
    
    });

    Route::group(['prefix'  =>   'location'], function() {

        Route::get('/', 'Admin\LocationController@index')->name('admin.locations.index');
        Route::get('/create', 'Admin\LocationController@create')->name('admin.locations.create');
        Route::post('/store', 'Admin\LocationController@store')->name('admin.locations.store');
        Route::get('/{id}/edit', 'Admin\LocationController@edit')->name('admin.locations.edit');
        Route::post('/update', 'Admin\LocationController@update')->name('admin.locations.update');
        Route::get('/{id}/delete', 'Admin\LocationController@delete')->name('admin.locations.delete');
    
    });

    Route::group(['prefix'  =>   'shapes'], function() {

        Route::get('/', 'Admin\ShapeController@index')->name('admin.shapes.index');
        Route::get('/create', 'Admin\ShapeController@create')->name('admin.shapes.create');
        Route::post('/store', 'Admin\ShapeController@store')->name('admin.shapes.store');
        Route::get('/{id}/edit', 'Admin\ShapeController@edit')->name('admin.shapes.edit');
        Route::post('/update', 'Admin\ShapeController@update')->name('admin.shapes.update');
        Route::get('/{id}/delete', 'Admin\ShapeController@delete')->name('admin.shapes.delete');
    });

    Route::group(['prefix'  =>   'colors'], function() {

        Route::get('/admin', 'Admin\ColorController@index')->name('admin.colors.index');
        Route::get('/create', 'Admin\ColorController@create')->name('admin.colors.create');
        Route::post('/store', 'Admin\ColorController@store')->name('admin.colors.store');
        Route::get('/{id}/edit', 'Admin\ColorController@edit')->name('admin.colors.edit');
        Route::post('/update', 'Admin\ColorController@update')->name('admin.colors.update');
        Route::get('/{id}/delete', 'Admin\ColorController@delete')->name('admin.colors.delete');
    
    });

    Route::group(['prefix'  =>   'colorstates'], function() {

        Route::get('/', 'Admin\ColorStateController@index')->name('admin.colorstates.index');
        Route::get('/create', 'Admin\ColorStateController@create')->name('admin.colorstates.create');
        Route::post('/store', 'Admin\ColorStateController@store')->name('admin.colorstates.store');
        Route::get('/{id}/edit', 'Admin\ColorStateController@edit')->name('admin.colorstates.edit');
        Route::post('/update', 'Admin\ColorStateController@update')->name('admin.colorstates.update');
        Route::get('/{id}/delete', 'Admin\ColorStateController@delete')->name('admin.colorstates.delete');
    
    });

    Route::group(['prefix'  =>   'disease'], function() {

        Route::get('/', 'Admin\DiseaseController@index')->name('admin.disease.index');
        Route::get('/create', 'Admin\DiseaseController@create')->name('admin.diseases.create');
        Route::post('/store', 'Admin\DiseaseController@store')->name('admin.diseases.store');
        Route::get('/{id}/edit', 'Admin\DiseaseController@edit')->name('admin.diseases.edit');
        Route::post('/update', 'Admin\DiseaseController@update')->name('admin.diseases.update');
        Route::get('/{id}/delete', 'Admin\DiseaseController@delete')->name('admin.diseases.delete');
    
    });

    Route::group(['prefix'  =>   'disease-details'], function() {

        Route::get('/', 'Admin\DiseaseDetailController@index')->name('admin.disease-details.index');
        Route::get('/create', 'Admin\DiseaseDetailController@create')->name('admin.disease-details.create');
        Route::post('/store', 'Admin\DiseaseDetailController@store')->name('admin.disease-details.store');
        Route::get('/{id}/edit', 'Admin\DiseaseDetailController@edit')->name('admin.disease-details.edit');
        Route::post('/update', 'Admin\DiseaseDetailController@update')->name('admin.disease-details.update');
        Route::get('/{id}/delete', 'Admin\DiseaseDetailController@delete')->name('admin.disease-details.delete');
    
    });

});
});
