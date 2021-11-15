<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\ColorContract;
use App\Http\Controllers\BaseController;

class ColorController extends BaseController
{
    /**
     * @var ColorContract
     */
    protected $colorRepository;

    /**
     * CategoryController constructor.
     * @param ColorContract $colorRepository
     */
    public function __construct(ColorContract $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

        /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $colors = $this->colorRepository->listColors();

        $this->setPageTitle('Colors', 'List of all colors');
        return view('admin.colors.index', compact('colors'));
    }

        /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Colors', 'Create Color');
        return view('admin.colors.create');
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

        $color = $this->colorRepository->createColor($params);

        if (!$color) {
            return $this->responseRedirectBack('Error occurred while creating color.', 'error', true, true);
        }
        return $this->responseRedirect('admin.colors.index', 'Color added successfully' ,'success',false, false);
    }
        /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $color = $this->colorRepository->findColorById($id);

        $this->setPageTitle('Colors', 'Edit Color : '.$color->name);
        return view('admin.colors.edit', compact('color'));
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

        $color = $this->colorRepository->updateColor($params);

        if (!$color) {
            return $this->responseRedirectBack('Error occurred while updating color.', 'error', true, true);
        }
        return $this->responseRedirectBack('Color updated successfully' ,'success',false, false);
    }

        /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $color = $this->colorRepository->deleteColor($id);

        if (!$color) {
            return $this->responseRedirectBack('Error occurred while deleting color.', 'error', true, true);
        }
        return $this->responseRedirect('admin.colors.index', 'Color deleted successfully' ,'success',false, false);
    }
}