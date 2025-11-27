<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Village extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'villages';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    function taluka(){
        return $this->hasOne('App\Models\Taluka', 'id', 'taluka_id');
    }

    function villagestatistics(){
        return $this->hasMany('App\Models\VillageInfo\VillageStatistics', 'village_id', 'id');
    }

    function villagefacilities(){
        return $this->hasOne('App\Models\VillageInfo\VillageFacility', 'village_id', 'id');
    }

}