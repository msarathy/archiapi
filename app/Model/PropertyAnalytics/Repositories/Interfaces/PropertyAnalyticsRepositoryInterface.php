<?php
namespace App\Model\PropertyAnalytics\Repositories\Interfaces;
use App\Model\PropertyAnalytics\PropertyAnalytics;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Boolean;

interface PropertyAnalyticsRepositoryInterface
{
    public function createPropertyAnalytics(array $data) : PropertyAnalytics;

    public function updatePropertyAnalytics(array $data);

    public function findPropertyAnalyticsById(int $id) : PropertyAnalytics;

    public function detachAnalyticTypes();

    public function getAnalyticTypes() : Collection;

    public function syncAnalyticTypes(array $params);
}
