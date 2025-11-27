<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    function states(){
        return $this->hasMany('App\Models\State', 'country_id', 'id');
    }
    
    function profilepoliticians(){
        return $this->hasMany('App\Models\VillageInfo\ProfilePoliticians', 'country_id', 'id');
    }

}
