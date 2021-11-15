<?php

namespace App\Repositories;

use App\ColorState;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ColorStateContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class ColorStateRepository extends BaseRepository implements ColorStateContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param ColorState $model
     */
    public function __construct(ColorState $model)
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
    public function listColorStates(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findColorStateById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return ColorState|mixed
     */
    public function createColorState(array $params)
    {
        try {
            $collection = collect($params);

            $logo = null;

            if ($collection->has('logo') && ($params['logo'] instanceof  UploadedFile)) {
                $logo = $this->uploadOne($params['logo'], 'colorstates');
            }

            $merge = $collection->merge(compact('logo'));

            $colorstate = new ColorState($merge->all());

            $colorstate->save();

            return $colorstate;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateColorState(array $params)
    {
        $colorstate = $this->findColorStateById($params['id']);

        $collection = collect($params)->except('_token');
        $logo = null;
        if ($collection->has('logo') && ($params['logo'] instanceof  UploadedFile)) {

            if ($colorstate->logo != null) {
                $this->deleteOne($colorstate->logo);
            }

            $logo = $this->uploadOne($params['logo'], 'colorstates');
        }

        $merge = $collection->merge(compact('logo'));

        $colorstate->update($merge->all());

        return $colorstate;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteColorState($id)
    {
        $colorstate = $this->findColorStateById($id);

        if ($colorstate->logo != null) {
            $this->deleteOne($colorstate->logo);
        }

        $colorstate->delete();

        return $colorstate;
    }
}