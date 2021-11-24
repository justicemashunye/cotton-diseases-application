<?php

namespace App\Repositories;

use App\Disease;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\DiseaseContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class DiseaseRepository extends BaseRepository implements DiseaseContract
{
    use UploadAble;

    public function __construct(Disease $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    
    public function listDiseases(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findDiseaseById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

   
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