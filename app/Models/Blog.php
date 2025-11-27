<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Blog extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';

    protected $appends = ['blog_image','blog_image_name','first_image','first_image_name','second_image','second_image_name','third_image','third_image_name','fourth_image','fourth_image_name','fifth_image','fifth_image_name','six_image','six_image_name','seven_image','seven_image_name','eight_image','eight_image_name','nine_image','nine_image_name','ten_image','ten_image_name'];
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];
    
    public function getBlogImageAttribute() {

        if (isset($this->attributes['blog_image']) && !empty($this->attributes['blog_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['blog_image']);
        } else {

            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getBlogImageNameAttribute() {

        if (isset($this->attributes['blog_image']) && !empty($this->attributes['blog_image'])) {

            $image = $this->attributes['blog_image'];
        } else {

            $image = "";
        }

        return $image;
    }

    public function getFirstImageAttribute() {

        if (isset($this->attributes['first_image']) && !empty($this->attributes['first_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['first_image']);
        } else {
            
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getFirstImageNameAttribute() {

        if (isset($this->attributes['first_image']) && !empty($this->attributes['first_image'])) {

            $image = $this->attributes['first_image'];
        } else {

            $image = "";
        }

        return $image;
    }

    public function getSecondImageAttribute() {

        if (isset($this->attributes['second_image']) && !empty($this->attributes['second_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['second_image']);
        } else {
            
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getSecondImageNameAttribute() {

        if (isset($this->attributes['second_image']) && !empty($this->attributes['second_image'])) {

            $image = $this->attributes['second_image'];
        } else {

            $image = "";
        }

        return $image;
    }

    public function getThirdImageAttribute() {

        if (isset($this->attributes['third_image']) && !empty($this->attributes['third_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['third_image']);
        } else {
            
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getThirdImageNameAttribute() {

        if (isset($this->attributes['third_image']) && !empty($this->attributes['third_image'])) {

            $image = $this->attributes['third_image'];
        } else {

            $image = "";
        }

        return $image;
    }

    public function getFourthImageAttribute() {

        if (isset($this->attributes['fourth_image']) && !empty($this->attributes['fourth_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['fourth_image']);
        } else {
            
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getFourthImageNameAttribute() {

        if (isset($this->attributes['fourth_image']) && !empty($this->attributes['fourth_image'])) {

            $image = $this->attributes['fourth_image'];
        } else {

            $image = "";
        }

        return $image;
    }
    
     public function getFifthImageAttribute() {

        if (isset($this->attributes['fifth_image']) && !empty($this->attributes['fifth_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['fifth_image']);
        } else {
            
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getFifthImageNameAttribute() {

        if (isset($this->attributes['fifth_image']) && !empty($this->attributes['fifth_image'])) {

            $image = $this->attributes['fifth_image'];
        } else {

            $image = "";
        }

        return $image;
    }

    public function getSixImageAttribute() {

        if (isset($this->attributes['six_image']) && !empty($this->attributes['six_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['six_image']);
        } else {
            
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getSixImageNameAttribute() {

        if (isset($this->attributes['six_image']) && !empty($this->attributes['six_image'])) {

            $image = $this->attributes['six_image'];
        } else {

            $image = "";
        }

        return $image;
    }

    public function getSevenImageAttribute() {

        if (isset($this->attributes['seven_image']) && !empty($this->attributes['seven_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['seven_image']);
        } else {
            
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getSevenImageNameAttribute() {

        if (isset($this->attributes['seven_image']) && !empty($this->attributes['seven_image'])) {

            $image = $this->attributes['seven_image'];
        } else {

            $image = "";
        }

        return $image;
    }

    public function getEightImageAttribute() {

        if (isset($this->attributes['eight_image']) && !empty($this->attributes['eight_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['eight_image']);
        } else {
            
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getEightImageNameAttribute() {

        if (isset($this->attributes['eight_image']) && !empty($this->attributes['eight_image'])) {

            $image = $this->attributes['eight_image'];
        } else {

            $image = "";
        }

        return $image;
    }

    public function getNineImageAttribute() {

        if (isset($this->attributes['nine_image']) && !empty($this->attributes['nine_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['nine_image']);
        } else {
            
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getNineImageNameAttribute() {

        if (isset($this->attributes['nine_image']) && !empty($this->attributes['nine_image'])) {

            $image = $this->attributes['nine_image'];
        } else {

            $image = "";
        }

        return $image;
    }

    public function getTenImageAttribute() {

        if (isset($this->attributes['ten_image']) && !empty($this->attributes['ten_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['ten_image']);
        } else {
            
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getTenImageNameAttribute() {

        if (isset($this->attributes['ten_image']) && !empty($this->attributes['ten_image'])) {

            $image = $this->attributes['ten_image'];
        } else {

            $image = "";
        }

        return $image;
    }

    function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
    function category(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    function subcategory(){
        return $this->hasOne('App\Models\SubCategory', 'id', 'sub_category_id');
    }

    function blogimages(){
        return $this->hasMany('App\Models\BlogImage', 'blog_id', 'id');
    }
    
    function comments(){
        return $this->hasMany('App\Models\Comment', 'blog_id', 'id')->where('is_active', 1)->orderBy('id', 'desc');
    }
    
    public function relatedBlogs()
    {
        return $this->hasOne(Blog::class, 'id', 'related_blog_id');
    }
    
    public function relatedSecondBlogs()
    {
        return $this->hasOne(Blog::class, 'id', 'second_related_blog');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    
    // public function getBlogTitleAttribute()
    // {
    //     return Str::words($this->blog_title, 10, '');
    // }
    
}
