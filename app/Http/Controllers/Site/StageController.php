<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\StageContract;

class StageController extends Controller
{
    protected $stageRepository;

    public function __construct(StageContract $stageRepository)
    {
        $this->stageRepository = $stageRepository;
    }

    public function show($slug)
    {
        $stage = $this->stageRepository->findBySlug($id);

        return view('site.pages.stage', compact('stage'));
    }

    public function index()
    {
        $stages = $this->stageRepository->listStages();
        dd($stages);
        //return view('site.pages.stage', compact('stage'));
    }
}