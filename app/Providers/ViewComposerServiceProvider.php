<?php

namespace App\Providers;

use App\Stage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        View::composer('site.pages.homepage', function ($view) {
            $view->with('stages', Stage::orderByRaw('-name ASC')->get());
        });
    }
}

