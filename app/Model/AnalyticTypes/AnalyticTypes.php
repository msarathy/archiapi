<?php

namespace App\Model\AnalyticTypes;

use Illuminate\Database\Eloquent\Model;

class AnalyticTypes extends Model
{
    protected $table = 'analytic_types';
    protected $primaryKey = 'id';

    public function property_analytics()
    {
        return $this->belongsToMany(AnalyticTypes::class);
    }
}
