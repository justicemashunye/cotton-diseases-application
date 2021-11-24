<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Contracts\DiseaseDetailContract;
use App\Contracts\DiseaseContract;
use Illuminate\Support\Facades\Auth;
use App\DiseaseDetail;

class DiseaseDetailController extends BaseController
{
    //
    protected $diseasedetailRepository;
    protected $diseaseRepository;

    public function __construct(DiseaseDetailContract $diseasedetailRepository,DiseaseContract $diseaseRepository)
    {
        $this->diseasedetailRepository = $diseasedetailRepository;
        $this->diseaseRepository = $diseaseRepository;
    }

    public function index()
    {
        $diseasedetails = $this->diseasedetailRepository->listDiseaseDetails();

        $this->setPageTitle('DiseaseDetails', 'List of all diseasedetails');
        return view('admin.diseasedetails.index', compact('diseasedetails'));
    }

    public function create()
    {
      
        $diseases = $this->diseaseRepository->listDiseases('id', 'asc');

        $this->setPageTitle('DiseaseDetails', 'Create DiseaseDetail');
        return view('admin.diseasedetails.create', compact('diseases'));

    }

    public function store(Request $request)
    {
       
        $this->validate($request, [
            'name'=> 'required',
            'description'=> 'required',
            'symptoms' =>  'required',
            'mode_of_transmission'=>  'required',
            'control' =>  'required'
        ]);

            $user = DiseaseDetail::where('name', '=', $request->name)->first();
            if ($user === null) {
                
                $params = $request->except('_token') ;
        
        $diseasedetail = $this->diseasedetailRepository->createDiseaseDetail($params);

        if (!$diseasedetail) {
            return $this->responseRedirectBack('Error occurred while creating diseasedetail.', 'error', true, true);
        }
        return $this->responseRedirect('admin.disease-details.index', 'DiseaseDetail added successfully' ,'success',false, false);
                }
                else{
                    return $this->responseRedirectBack('Record already.', 'error', true, true);
                }
    }

    public function edit($id)
    {
        $diseases = $this->diseaseRepository->listDiseases('name', 'asc');
        $diseasedetail = $this->diseasedetailRepository->findDiseaseDetailById($id);

        $this->setPageTitle('DiseaseDetails', 'Edit DiseaseDetail : '.$diseasedetail->name);
        return view('admin.diseasedetails.edit', compact('diseases','diseasedetail'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'description'          =>  'required',
            'symptoms' =>  'required',
            'mode_of_transmission'          =>  'required',
            'control' =>  'required'
        ]);

        $params = $request->except('_token');

        $diseasedetail = $this->diseasedetailRepository->updateDiseaseDetail($params);

        if (!$diseasedetail) {
            return $this->responseRedirectBack('Error occurred while updating diseasedetail.', 'error', true, true);
        }
        return $this->responseRedirectBack('DiseaseDetail updated successfully' ,'success',false, false);
    }
}