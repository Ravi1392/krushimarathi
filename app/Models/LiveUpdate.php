<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiveUpdate extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'live_updates';

    protected $appends = ['live_update_image','live_update_image_name'];
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];

    public function getLiveUpdateImageAttribute() {

        return asset("/public/live.webp");
    }

    public function getLiveUpdateImageNameAttribute() {


        return "live.webp";
    }

    function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    function liveupdatesdata(){
        return $this->hasMany('App\Models\LiveUpdateData', 'live_update_id', 'id')->orderBy('id', 'desc');
    }
    
    function liveupdatedata(){
        return $this->hasOne('App\Models\LiveUpdateData', 'live_update_id', 'id')->orderBy('id', 'desc');
    }

}
