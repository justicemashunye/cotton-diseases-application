<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\ShapeContract;
use App\Http\Controllers\BaseController;

class ShapeController extends BaseController
{
    /**
     * @var ShapeContract
     */
    protected $shapeRepository;

    /**
     * CategoryController constructor.
     * @param ShapeContract $shapeRepository
     */
    public function __construct(ShapeContract $shapeRepository)
    {
        $this->shapeRepository = $shapeRepository;
    }

        /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $shapes = $this->shapeRepository->listShapes();

        $this->setPageTitle('Shapes', 'List of all shapes');
        return view('admin.shapes.index', compact('shapes'));
    }

        /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Shapes', 'Create Shape');
        return view('admin.shapes.create');
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

        $shape = $this->shapeRepository->createShape($params);

        if (!$shape) {
            return $this->responseRedirectBack('Error occurred while creating shape.', 'error', true, true);
        }
        return $this->responseRedirect('admin.shapes.index', 'Shape added successfully' ,'success',false, false);
    }
        /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $shape = $this->shapeRepository->findShapeById($id);

        $this->setPageTitle('Shapes', 'Edit Shape : '.$shape->name);
        return view('admin.shapes.edit', compact('shape'));
    }

        /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'description'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $shape = $this->shapeRepository->updateShape($params);

        if (!$shape) {
            return $this->responseRedirectBack('Error occurred while updating shape.', 'error', true, true);
        }
        return $this->responseRedirectBack('Shape updated successfully' ,'success',false, false);
    }

        /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $shape = $this->shapeRepository->deleteShape($id);

        if (!$shape) {
            return $this->responseRedirectBack('Error occurred while deleting shape.', 'error', true, true);
        }
        return $this->responseRedirect('admin.shapes.index', 'Shape deleted successfully' ,'success',false, false);
    }
}