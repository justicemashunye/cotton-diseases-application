<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\ColorStateContract;
use App\Http\Controllers\BaseController;

class ColorStateController extends BaseController
{
    /**
     * @var ColorStateContract
     */
    protected $colorstateRepository;

 
    public function __construct(ColorStateContract $colorstateRepository)
    {
        $this->colorstateRepository = $colorstateRepository;
    }

    
    public function index()
    {
        $colorstates = $this->colorstateRepository->listColorStates();

        $this->setPageTitle('ColorStates', 'List of all colorstates');
        return view('admin.colorstates.index', compact('colorstates'));
    }

        /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('ColorStates', 'Create ColorState');
        return view('admin.colorstates.create');
    }

        /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $colorstate = $this->colorstateRepository->createColorState($params);

        if (!$colorstate) {
            return $this->responseRedirectBack('Error occurred while creating colorstate.', 'error', true, true);
        }
        return $this->responseRedirect('admin.colorstates.index', 'ColorState added successfully' ,'success',false, false);
    }

    public function edit($id)
    {
        $colorstate = $this->colorstateRepository->findColorStateById($id);

        $this->setPageTitle('ColorStates', 'Edit ColorState : '.$colorstate->description);
        return view('admin.colorstates.edit', compact('colorstate'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'description'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $colorstate = $this->colorstateRepository->updateColorState($params);

        if (!$colorstate) {
            return $this->responseRedirectBack('Error occurred while updating colorstate.', 'error', true, true);
        }
        return $this->responseRedirectBack('ColorState updated successfully' ,'success',false, false);
    }

        /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $colorstate = $this->colorstateRepository->deleteColorState($id);

        if (!$colorstate) {
            return $this->responseRedirectBack('Error occurred while deleting colorstate.', 'error', true, true);
        }
        return $this->responseRedirect('admin.colorstates.index', 'ColorState deleted successfully' ,'success',false, false);
    }
}