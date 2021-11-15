<?php
namespace App\Repositories;

use App\Location;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\LocationContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class LocationRepository extends BaseRepository implements LocationContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param Location $model
     */
    public function __construct(Location $model)
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
    public function listLocations(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findLocationById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Location|mixed
     */
    public function createLocation(array $params)
    {
        try {
            $collection = collect($params);

            $image = null;

            if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'locations');
            }

            $merge = $collection->merge(compact('image'));

            $location = new Location($merge->all());

            $location->save();

            return $location;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateLocation(array $params)
    {
        $location = $this->findLocationById($params['id']);

        $collection = collect($params)->except('_token');

        if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {

            if ($location->image != null) {
                $this->deleteOne($location->image);
            }

            $image = $this->uploadOne($params['image'], 'locations');
        }

        $merge = $collection->merge(compact('image'));

        $location->update($merge->all());

        return $location;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteLocation($id)
    {
        $location = $this->findLocationById($id);

        if ($location->image != null) {
            $this->deleteOne($location->image);
        }

        $location->delete();

        return $location;
    }
}