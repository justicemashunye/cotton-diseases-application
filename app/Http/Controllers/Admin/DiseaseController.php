<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\DiseaseContract;
use App\Http\Controllers\BaseController;

class DiseaseController extends BaseController
{
    /**
     * @var DiseaseContract
     */
    protected $diseaseRepository;

    /**
     * CategoryController constructor.
     * @param DiseaseContract $diseaseRepository
     */
    public function __construct(DiseaseContract $diseaseRepository)
    {
        $this->diseaseRepository = $diseaseRepository;
    }

        /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $diseases = $this->diseaseRepository->listDiseases();

        $this->setPageTitle('Diseases', 'List of all diseases');
        return view('admin.diseases.index', compact('diseases'));
    }

        /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Diseases', 'Create Disease');
        return view('admin.diseases.create');
    }

        /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191'

        ]);

        $params = $request->except('_token');

        $disease = $this->diseaseRepository->createDisease($params);

        if (!$disease) {
            return $this->responseRedirectBack('Error occurred while creating disease.', 'error', true, true);
        }
        return $this->responseRedirect('admin.diseases.index', 'Disease added successfully' ,'success',false, false);
    }
        /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $disease = $this->diseaseRepository->findDiseaseById($id);

        $this->setPageTitle('Diseases', 'Edit Disease : '.$disease->name);
        return view('admin.diseases.edit', compact('disease'));
    }

        /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
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

        /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $disease = $this->diseaseRepository->deleteDisease($id);

        if (!$disease) {
            return $this->responseRedirectBack('Error occurred while deleting disease.', 'error', true, true);
        }
        return $this->responseRedirect('admin.diseases.index', 'Disease deleted successfully' ,'success',false, false);
    }
}