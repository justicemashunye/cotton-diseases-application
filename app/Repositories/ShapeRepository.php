<?php

namespace App\Repositories;

use App\Shape;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ShapeContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class ShapeRepository extends BaseRepository implements ShapeContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param Shape $model
     */
    public function __construct(Shape $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listShapes(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findShapeById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Shape|mixed
     */
    public function createShape(array $params)
    {
        try {
            $collection = collect($params);

            $image = null;

            if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'shapes');
            }

            $merge = $collection->merge(compact('image'));

            $shape = new Shape($merge->all());

            $shape->save();

            return $shape;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateShape(array $params)
    {
        $shape = $this->findShapeById($params['id']);

        $collection = collect($params)->except('_token');
        $image = null;
        if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {

            if ($shape->image != null) {
                $this->deleteOne($shape->image);
            }

            $image = $this->uploadOne($params['image'], 'shapes');
        }

        $merge = $collection->merge(compact('image'));

        $shape->update($merge->all());

        return $shape;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteShape($id)
    {
        $shape = $this->findShapeById($id);

        if ($shape->image != null) {
            $this->deleteOne($shape->image);
        }

        $shape->delete();

        return $shape;
    }
}