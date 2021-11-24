<?php

namespace App\Repositories;

use App\DiseaseDetail;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\DiseaseDetailContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Auth;

class DiseaseDetailRepository extends BaseRepository implements DiseaseDetailContract
{
    use UploadAble;

    
    public function __construct(DiseaseDetail $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

  
    public function listDiseaseDetails(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

  
    public function findDiseaseDetailById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

   
    public function createDiseaseDetail(array $params)
    {
          
        try {
            $collection = collect($params);
           
            $logo = null;

            if ($collection->has('logo') && ($params['logo'] instanceof  UploadedFile)) {
                $logo = $this->uploadOne($params['logo'], 'diseasedetails');
            }
        
            $merge = $collection->merge(compact('logo'));
           

            $diseasedetail = new DiseaseDetail($merge->all());   
                   
            $diseasedetail->save();

            return $diseasedetail;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateDiseaseDetail(array $params)
    {
        $diseasedetail = $this->findDiseaseDetailById($params['id']);

        $collection = collect($params)->except('_token');
        $logo = null;
        if ($collection->has('logo') && ($params['logo'] instanceof  UploadedFile)) {

            if ($diseasedetail->logo != null) {
                $this->deleteOne($diseasedetail->logo);
            }

            $logo = $this->uploadOne($params['logo'], 'diseasedetails');
        }

        $merge = $collection->merge(compact('logo'));

        $diseasedetail->update($merge->all());

        return $diseasedetail;
    }

    
    public function deleteDiseaseDetail($id)
    {
        $diseasedetail = $this->findDiseaseDetailById($id);

        if ($diseasedetail->logo != null) {
            $this->deleteOne($diseasedetail->logo);
        }

        $diseasedetail->delete();

        return $diseasedetail;
    }
}