<?php

namespace App\Models\Advertisement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model {

    use SoftDeletes;
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ads_sub_categories';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    function category(){
        return $this->hasOne('App\Models\Advertisement\Category', 'id', 'ads_category_id');
    }

    function products(){
        return $this->hasMany('App\Models\Advertisement\Product', 'sub_category_id', 'id');
    }
  
}
