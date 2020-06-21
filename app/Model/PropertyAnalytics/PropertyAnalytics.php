<?php

namespace App\Model\PropertyAnalytics;

use App\Model\AnalyticTypes\AnalyticTypes;
use App\Model\Properties\Property;
use Illuminate\Database\Eloquent\Model;

class PropertyAnalytics extends Model
{
    protected $table = 'property_analytics';
    protected $primaryKey = 'id';

    protected $fillable = [ 'property_id', 'analytic_types_id', 'value' ];

    public function analytic_types()
    {
        return $this->belongsToMany(Property::class, 'property_analytics', 'id','analytic_types_id');
    }

}
