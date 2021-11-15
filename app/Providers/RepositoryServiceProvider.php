<?php

namespace App\Providers;

use App\Contracts\StageContract;
use Illuminate\Support\ServiceProvider;
use App\Repositories\StageRepository;
use App\Contracts\LocationContract;
use App\Repositories\LocationRepository;
use App\Contracts\ShapeContract;
use App\Repositories\ShapeRepository;
use App\Contracts\ColorContract;
use App\Repositories\ColorRepository;
use App\Contracts\ColorStateContract;
use App\Repositories\ColorStateRepository;
use App\Contracts\DiseaseContract;
use App\Repositories\DiseaseRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        StageContract::class         =>          StageRepository::class,
        LocationContract::class            =>          LocationRepository::class,
        ShapeContract::class            =>          ShapeRepository::class,
        ColorContract::class            =>          ColorRepository::class,
        ColorStateContract::class            =>          ColorStateRepository::class,
        DiseaseContract::class            =>          DiseaseRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
    }
}