<?php

namespace App\Model\PropertyAnalytics\Transformations;

use App\Model\PropertyAnalytics\PropertyAnalytics;

trait PropertyAnalyticsTransformable
{
    /**
     * transform the Property Analytics
     *
     * @param PropertyAnalytics $propertyAnalytics
     * @return PropertyAnalytics
     */
    protected function transformPropertyAnalytics(PropertyAnalytics $propertyAnalytics)
    {
        $analytics = new PropertyAnalytics;
        $analytics->id = (int)$propertyAnalytics->id;
        $analytics->property_id = (int)$propertyAnalytics->property_id;
        $analytics->analytic_types_id = (int)$propertyAnalytics->analytic_types_id;
        $analytics->value = (string)$propertyAnalytics->value;

        return $analytics;
    }
}
