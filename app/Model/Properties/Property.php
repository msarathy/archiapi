<?php

namespace App\Model\Properties;

use App\Model\PropertyAnalytics\PropertyAnalytics;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Property extends Model
{
    protected $table = 'properties';
    protected $primaryKey = 'id';

    protected $fillable = [
       'suburb', 'state', 'country'
    ];

    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->guid = Uuid::generate()->string;
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function property_analytics()
    {
        return $this->belongsToMany(PropertyAnalytics::class);
    }


}
