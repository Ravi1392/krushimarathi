<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];
    
    function blogs(){
        return $this->hasMany('App\Models\Blog', 'category_id', 'id');
    }

    function subCategory(){
        return $this->hasOne('App\Models\SubCategory', 'category_id', 'id');
    }
    
    function subCategories(){
        return $this->hasMany('App\Models\SubCategory', 'category_id', 'id');
    }

    public function webStories()
    {
        return $this->hasMany(Webstories::class, 'category_id');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    
}
