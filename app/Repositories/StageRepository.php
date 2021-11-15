<?php
namespace App\Repositories;

use App\Stage;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\StageContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;


class StageRepository extends BaseRepository implements StageContract
{
    use UploadAble;

    public function __construct(Stage $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listStages(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findStageById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    public function createStage(array $params)
    {
        try {
            $collection = collect($params);
            
            $image = null;

            if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'stages');
            }

            $featured = $collection->has('featured') ? 1 : 0;
            $menu = $collection->has('menu') ? 1 : 0;

            $merge = $collection->merge(compact('menu', 'image', 'featured'));

            $stage = new Stage($merge->all());

            $stage->save();

            return $stage;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

        public function updateStage(array $params)
    {
        $stage = $this->findStageById($params['id']);

        $collection = collect($params)->except('_token');

        if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {

            if ($stage->image != null) {
                $this->deleteOne($stage->image);
            }

            $image = $this->uploadOne($params['image'], 'stages');
        }

        $featured = $collection->has('featured') ? 1 : 0;
        $menu = $collection->has('menu') ? 1 : 0;

        $merge = $collection->merge(compact('menu', 'image', 'featured'));

        $stage->update($merge->all());

        return $stage;
    }

        public function deleteStage($id)
    {
        $stage = $this->findStageById($id);

        if ($stage->image != null) {
            $this->deleteOne($stage->image);
        }

        $stage->delete();

        return $stage;
    }

    public function treeList()
    {
        return Stage::orderByRaw('-name ASC')
            ->get();
            
    }

        public function findBySlug($slug)
    {
        return Stage::with('products')
            ->where('slug', $slug)
            ->where('menu', 1)
            ->first();
    }


}