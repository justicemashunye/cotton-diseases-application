<?php

namespace App\Repositories;

use App\Disease;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\DiseaseContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class DiseaseRepository extends BaseRepository implements DiseaseContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param Disease $model
     */
    public function __construct(Disease $model)
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
    public function listDiseases(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findDiseaseById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Disease|mixed
     */
    public function createDisease(array $params)
    {
        try {
            $collection = collect($params);

            $image = null;

            if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'diseases');
            }

            $merge = $collection->merge(compact('image'));

            $disease = new Disease($merge->all());

            $disease->save();

            return $disease;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateDisease(array $params)
    {
        $disease = $this->findDiseaseById($params['id']);

        $collection = collect($params)->except('_token');
        $image = null;
        if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {

            if ($disease->image != null) {
                $this->deleteOne($disease->image);
            }

            $image = $this->uploadOne($params['image'], 'diseases');
        }

        $merge = $collection->merge(compact('image'));

        $disease->update($merge->all());

        return $disease;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteDisease($id)
    {
        $disease = $this->findDiseaseById($id);

        if ($disease->image != null) {
            $this->deleteOne($disease->image);
        }

        $disease->delete();

        return $disease;
    }
}