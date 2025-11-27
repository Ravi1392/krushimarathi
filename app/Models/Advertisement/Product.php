<?php

namespace App\Models\Advertisement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model {

    use SoftDeletes;
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ads_products';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];

    protected $appends = ['photo', 'photo_name'];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeStatus($query)
    {
        return $query->where('status','=', 'Approved');
    }

    public function getPhotoAttribute() {
        if (isset($this->attributes['photo']) && !empty($this->attributes['photo'])) {
    
            $imagePath = asset("/public/assets/advertisement/images/product/" . $this->attributes['photo']);
        } else {
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getPhotoNameAttribute() {

        if (isset($this->attributes['photo']) && !empty($this->attributes['photo'])) {

            $image = $this->attributes['photo'];
        } else {

            $image = "";
        }

        return $image;
    }

    function customer(){
        return $this->hasOne('App\Models\Advertisement\Customer', 'id', 'customer_id');
    }

    function category(){
        return $this->hasOne('App\Models\Advertisement\Category', 'id', 'category_id');
    }

    function subcategory(){
        return $this->hasOne('App\Models\Advertisement\SubCategory', 'id', 'sub_category_id');
    }

    function unit(){
        return $this->hasOne('App\Models\Advertisement\Unit', 'id', 'unit_id');
    }

    function state(){
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }

    function district(){
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }

    public function wishlists()
    {
        return $this->hasMany('App\Models\Advertisement\Wishlist', 'product_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Advertisement\Comment', 'product_id', 'id');
    }
  
}
