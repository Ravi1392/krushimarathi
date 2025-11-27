<?php

namespace App\Models\Bajarbhav;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class CropRate extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'crop_rates';

    function crop_name(){
        return $this->hasOne('App\Models\Bajarbhav\CropName', 'id', 'crop_id');
    }

}
