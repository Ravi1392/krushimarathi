<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'districts';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    function state(){
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }

    function talukas(){
        return $this->hasMany('App\Models\Taluka', 'district_id', 'id');
    }

}
