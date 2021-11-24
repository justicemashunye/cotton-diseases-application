<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\DiseaseContract;
use App\Http\Controllers\BaseController;
use App\Contracts\DiseaseDetailContract;
use App\Contracts\StageContract;
use App\Contracts\LocationContract;
use App\Contracts\ShapeContract;
use App\Contracts\ColorStateContract;
use App\Contracts\ColorContract;



class DiseaseController extends BaseController
{
    
    protected $diseaseRepository;
    protected $diseasedetailRepository;
    protected $stageRepository;
    protected $shapeRepository;
    protected $locationRepository;
    protected $colorstateRepository;
    protected $colorRepository;


  
    public function __construct(DiseaseContract $diseaseRepository,
    DiseaseDetailContract $diseasedetailRepository,
    StageContract $stageRepository,
    ShapeContract $shapeRepository,
    LocationContract $locationRepository,
    ColorStateContract $colorstateRepository,
    ColorContract $colorRepository
    )
    {
        $this->diseaseRepository = $diseaseRepository;
        $this->diseasedetailRepository = $diseasedetailRepository;
        $this->stageRepository = $stageRepository;
        $this->shapeRepository = $shapeRepository;
        $this->locationRepository = $locationRepository;
        $this->colorstateRepository = $colorstateRepository;
        $this->colorRepository = $colorRepository;
    }

        
    public function index()
    {
        $diseases = $this->diseaseRepository->listDiseases();

        $this->setPageTitle('Diseases', 'List of all diseases');
        return view('admin.diseases.index', compact('diseases'));
    }

        
    public function create()
    {
        
        $stages = $this->stageRepository->listStages('name', 'asc');
        $diseasedetails = $this->diseasedetailRepository->listDiseaseDetails('name', 'asc');
        $shapes = $this->shapeRepository->listShapes('description', 'asc');
        $locations = $this->locationRepository->listLocations('name', 'asc');
        $colors = $this->colorRepository->listColors('name', 'asc');
        $colorstates = $this->colorstateRepository->listColorstates('description', 'asc');

        $this->setPageTitle('Diseases', 'Create Disease');
        return view('admin.diseases.create', compact('stages', 'diseasedetails','locations','shapes','colors','colorstates'));
        
    }

        
    public function store(Request $request)
    {
        $this->validate($request, [
            'disease_detail_id'     =>  'required',
            'stage_id'      =>  'required',
            'location_id'      =>  'required',
            'shape_id'      =>  'required',
            'color_id'      =>  'required',
            'color_state_id'   =>  'required'
        ]);

        $params = $request->except('_token');

        $disease = $this->diseaseRepository->createDisease($params);

        if (!$disease) {
            //return $this->responseRedirectBack('Error occurred while creating disease.', 'error', true, true);
            return $this->responseRedirect('Error occurred while creating disease.', 'error', true, true);
        }
        return $this->responseRedirect('admin.disease.index', 'Disease added successfully' ,'success',false, false);
    }
        
    public function edit($id)
    {
        $stages = $this->stageyRepository->listStages('name', 'asc');
        $diseasedetails = $this->diseasedetailRepository->listDiseaseDetails('name', 'asc');
        $locations = $this->locationRepository->listLocations('name', 'asc');
        $shapes = $this->shapeRepository->listShapes('name', 'asc');
        
        $disease = $this->diseaseRepository->findDiseaseById($id);

        $this->setPageTitle('Diseases', 'Edit Disease : '.$disease->name);
        return view('admin.diseases.edit', compact('disease','diseasedetails','stages','locations','shapes'));
    }

     
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191'
        ]);

        $params = $request->except('_token');

        $disease = $this->diseaseRepository->updateDisease($params);

        if (!$disease) {
            return $this->responseRedirectBack('Error occurred while updating disease.', 'error', true, true);
        }
        return $this->responseRedirectBack('Disease updated successfully' ,'success',false, false);
    }

        
    public function delete($id)
    {
        $disease = $this->diseaseRepository->deleteDisease($id);

        if (!$disease) {
            return $this->responseRedirectBack('Error occurred while deleting disease.', 'error', true, true);
        }
        return $this->responseRedirect('admin.diseases.index', 'Disease deleted successfully' ,'success',false, false);
    }
}