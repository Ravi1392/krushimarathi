<?php

namespace App\Models\VillageInfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class VillageStatistics extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'village_statistics';
    
    protected $fillable = [
        'village_id',
        'category_id',
        'total',
        'male',
        'female',
    ];

    function villagepopulationcategory(){
        return $this->hasOne('App\Models\VillageInfo\VillagePopulationCategory', 'id', 'category_id');
    }
}
