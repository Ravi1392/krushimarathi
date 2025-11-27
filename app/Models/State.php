<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'states';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    function districts(){
        return $this->hasMany('App\Models\District', 'state_id', 'id');
    }

    function country(){
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }

}
