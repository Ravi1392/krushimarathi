<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taluka extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'talukas';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    function district(){
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }

    function villages(){
        return $this->hasMany('App\Models\Village', 'taluka_id', 'id');
    }

}
