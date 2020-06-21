<?php

namespace App\Model\PropertyAnalytics\Repositories;

use App\Model\PropertyAnalytics\Transformations\PropertyAnalyticsTransformable;
use App\Model\PropertyAnalytics\Exceptions\PropertyAnalyticsCreateErrorException;
use App\Model\PropertyAnalytics\Exceptions\PropertyAnalyticsNotFoundException;
use App\Model\PropertyAnalytics\Repositories\Interfaces\PropertyAnalyticsRepositoryInterface;
use App\Model\PropertyAnalytics\PropertyAnalytics;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;

class PropertyAnalyticsRepository implements PropertyAnalyticsRepositoryInterface
{
    use PropertyAnalyticsTransformable;

    /**
     * @var PropertyAnalytics
     */
    protected $model;

    /**
     * PropertyAnalyticsRepository constructor.
     * @param PropertyAnalytics $model
     */
    public function __construct(PropertyAnalytics $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return PropertyAnalytics
     * @throws PropertyAnalyticsCreateErrorException
     */
    public function createPropertyAnalytics(array $data): PropertyAnalytics
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new PropertyAnalyticsCreateErrorException($e);
        }

    }

    /**
     * @param array $data
     * @return PropertyAnalytics
     * @throws PropertyAnalyticsCreateErrorException
     */
    public function updatePropertyAnalytics(array $data)
    {
        $filtered = collect($data)->all();
        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            throw new PropertyAnalyticsCreateErrorException($e);
        }
    }

    /**
     *  detach Analytic Types
     */
    public function detachAnalyticTypes()
    {
        $this->model->analytic_types()->detach();
    }

    /**
     * Return the analytic types which the property analytics is associated with
     *
     * @return Collection
     */
    public function getAnalyticTypes(): Collection
    {
        return $this->model->analytic_types()->get();
    }

    /**
     * Sync the analytic types
     *
     * @param array $params
     */
    public function syncAnalyticTypes(array $params)
    {
        $this->model->analytic_types()->sync($params);
    }

    /**
     * find the property analytics id
     *
     * @param int $id
     * @return PropertyAnalytics
     * @throws PropertyAnalyticsNotFoundException
     */
    public function findPropertyAnalyticsById(int $id): PropertyAnalytics
    {
        try {
            return $this->transformPropertyAnalytics($this->model->find($id));
        } catch (ModelNotFoundException $e) {
            throw new PropertyAnalyticsNotFoundException($e);
        }
    }

    /**
     * @param null $name
     * @param null $value
     */
    public function getAllSummary($name = null, $value = null)
    {

        return $this->model
            ->selectRaw(
                'MAX(property_analytics.value) AS max,
                 MIN(property_analytics.value) AS min,
                 avg(property_analytics.value) AS median,
                 COUNT(property_analytics.id) AS total')
            ->where($name, $value)
            ->leftjoin('properties', 'property_analytics.property_id', '=', 'properties.id')
            ->leftjoin('analytic_types', 'property_analytics.analytic_types_id', '=', 'analytic_types.id')
            ->get()->toArray();
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
