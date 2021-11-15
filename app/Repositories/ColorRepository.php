<?php

namespace App\Repositories;

use App\Color;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ColorContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class ColorRepository extends BaseRepository implements ColorContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param Color $model
     */
    public function __construct(Color $model)
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
    public function listColors(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findColorById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Color|mixed
     */
    public function createColor(array $params)
    {
        try {
            $collection = collect($params);

            $logo = null;

            if ($collection->has('logo') && ($params['logo'] instanceof  UploadedFile)) {
                $logo = $this->uploadOne($params['logo'], 'colors');
            }

            $merge = $collection->merge(compact('logo'));

            $color = new Color($merge->all());

            $color->save();

            return $color;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateColor(array $params)
    {
        $color = $this->findColorById($params['id']);

        $collection = collect($params)->except('_token');
        $logo = null;
        if ($collection->has('logo') && ($params['logo'] instanceof  UploadedFile)) {

            if ($color->logo != null) {
                $this->deleteOne($color->logo);
            }

            $logo = $this->uploadOne($params['logo'], 'colors');
        }

        $merge = $collection->merge(compact('logo'));

        $color->update($merge->all());

        return $color;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteColor($id)
    {
        $color = $this->findColorById($id);

        if ($color->logo != null) {
            $this->deleteOne($color->logo);
        }

        $color->delete();

        return $color;
    }
}