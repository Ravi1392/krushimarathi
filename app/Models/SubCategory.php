<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sub_categories';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];
    
    function category(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    
    function blogs(){
        return $this->hasMany('App\Models\Blog', 'sub_category_id', 'id');
    }

    // function blogs(){
    //     return $this->hasMany('App\Models\Blog', 'category_id', 'category_id');
    // }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
