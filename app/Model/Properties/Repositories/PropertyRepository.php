<?php

namespace App\Model\Properties\Repositories;

use App\Model\Properties\Exceptions\PropertyCreateErrorException;
use App\Model\Properties\Exceptions\PropertyUpdateErrorException;
use App\Model\Properties\Exceptions\PropertyNotFoundException;
use App\Model\Properties\Repositories\Interfaces\PropertyRepositoryInterface;
use App\Model\Properties\Property;
use Illuminate\Database\QueryException;
use phpDocumentor\Reflection\Types\Boolean;

class PropertyRepository implements PropertyRepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Property $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return Property
     * @throws PropertyCreateErrorException
     */
    public function createProperty(array $data): Property
    {
        try {
            return $this->model->create($data);

        } catch (QueryException $e) {
            throw new PropertyCreateErrorException($e);
        }

    }

    /**
     * @param array $data
     * @return bool
     * @throws PropertyUpdateErrorException
     */
    public function updateProperty(array $data): Boolean
    {
        $filtered = collect($data)->all();
        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            throw new PropertyUpdateErrorException($e);
        }
    }

    /**
     * @param null $name
     * @param null $value
     * @return Property
     */
    public function getAllSummary($name = null, $value = null)
    {

//        $result = $this->model
//            ->selectRaw(
//                'MAX(property_analytics.value) AS MAX_VALUE,
//                 MIN(property_analytics.value) AS MIN_VALUE,
//                 avg(property_analytics.value) AS MEDIAN_VALUE,
//                 (  (COUNT(property_analytics.value) / 100 ) * sum(property_analytics.value) ) as  WITH_VALUE')
//            ->where($name, $value)
//            ->Join('property_analytics', 'property_analytics.property_id', '=', 'properties.id')
//            ->get();

        $result = $this->model->with('property_analytics')
            ->select('property_analytics.*')
            ->where($name, $value)
            ->get()->toArray();
        dd($result);
        return $result;
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

}
