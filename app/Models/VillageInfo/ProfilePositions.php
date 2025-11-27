<?php

namespace App\Models\VillageInfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilePositions extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile_positions';
    
    protected $appends = ['photo','photo_name'];
    
    public function getPhotoAttribute() {

        if (isset($this->attributes['photo']) && !empty($this->attributes['photo'])) {

            $imagePath = asset("/public/assets/front/images/profile/" . $this->attributes['photo']);
        } else {

            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function gePhotoNameAttribute() {

        if (isset($this->attributes['photo']) && !empty($this->attributes['photo'])) {

            $image = $this->attributes['photo'];
        } else {

            $image = "";
        }

        return $image;
    }

    function profileposition(){
        return $this->hasOne('App\Models\VillageInfo\ProfilePositions', 'id', 'position_id');
    }

    function profilepoliticians(){
        return $this->hasMany('App\Models\VillageInfo\ProfilePersonPositions', 'profile_politicians_id', 'id');
    }

}
