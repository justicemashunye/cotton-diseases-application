<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\StageContract;
use App\Http\Controllers\BaseController;


class StageController extends BaseController
{
   
    public function __construct(StageContract $stageRepository)
    {
        $this->stageRepository = $stageRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $stages = $this->stageRepository->listStages();

        $this->setPageTitle('Stages', 'List of all stages');
        return view('admin.stages.index', compact('stages'));
    }

    

    public function create()
    {
        //$stages = $this->stageRepository->listStages('id', 'asc');
        $stages = $this->stageRepository->treeList();
        $this->setPageTitle('Stages', 'Create Stage');
        return view('admin.stages.create', compact('stages'));
    }

        /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $stage = $this->stageRepository->createStage($params);

        if (!$stage) {
            return $this->responseRedirectBack('Error occurred while creating stage.', 'error', true, true);
        }
        return $this->responseRedirect('admin.stages.index', 'Stage added successfully' ,'success',false, false);
    }

        /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetStage = $this->stageRepository->findStageById($id);
        //$stages = $this->stageRepository->listStages();
        $stages = $this->stageRepository->treeList();

        $this->setPageTitle('Stages', 'Edit Stage : '.$targetStage->name);
        return view('admin.stages.edit', compact('stages', 'targetStage'));
    }

       
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $stage = $this->stageRepository->updateStage($params);

        if (!$stage) {
            return $this->responseRedirectBack('Error occurred while updating stage.', 'error', true, true);
        }
        return $this->responseRedirectBack('Stage updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $stage = $this->stageRepository->deleteStage($id);

        if (!$stage) {
            return $this->responseRedirectBack('Error occurred while deleting stage.', 'error', true, true);
        }
        return $this->responseRedirect('admin.stages.index', 'Stage deleted successfully' ,'success',false, false);
    }


}