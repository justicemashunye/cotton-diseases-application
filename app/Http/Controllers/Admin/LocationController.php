<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\LocationContract;
use App\Http\Controllers\BaseController;

class LocationController extends BaseController
{
    /**
     * @var LocationContract
     */
    protected $locationRepository;

    /**
     * CategoryController constructor.
     * @param LocationContract $locationRepository
     */
    public function __construct(LocationContract $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

        /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $locations = $this->locationRepository->listLocations();

        $this->setPageTitle('Locations', 'List of all locations');
        return view('admin.locations.index', compact('locations'));
    }

        /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Locations', 'Create Location');
        return view('admin.locations.create');
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

        $location = $this->locationRepository->createLocation($params);

        if (!$location) {
            return $this->responseRedirectBack('Error occurred while creating location.', 'error', true, true);
        }
        return $this->responseRedirect('admin.locations.index', 'Location added successfully' ,'success',false, false);
    }
        /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $location = $this->locationRepository->findLocationById($id);

        $this->setPageTitle('Locations', 'Edit Location : '.$location->name);
        return view('admin.locations.edit', compact('location'));
    }

        /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $location = $this->locationRepository->updateLocation($params);

        if (!$location) {
            return $this->responseRedirectBack('Error occurred while updating location.', 'error', true, true);
        }
        return $this->responseRedirectBack('Location updated successfully' ,'success',false, false);
    }

        /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $location = $this->locationRepository->deleteLocation($id);

        if (!$location) {
            return $this->responseRedirectBack('Error occurred while deleting location.', 'error', true, true);
        }
        return $this->responseRedirect('admin.locations.index', 'Location deleted successfully' ,'success',false, false);
    }
}