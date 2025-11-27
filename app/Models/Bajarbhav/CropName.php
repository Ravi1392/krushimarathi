<?php

namespace App\Models\Bajarbhav;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class CropName extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'crop_names';
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    
    function crop_type(){
        return $this->hasOne('App\Models\Bajarbhav\CropType', 'id', 'crop_type_id');
    }

}
