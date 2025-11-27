<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webstories extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'visual_stories';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];
    
    protected $appends = ['file', 'file_name'];

    public function getFileAttribute() {
        if (isset($this->attributes['story_image']) && !empty($this->attributes['story_image'])) {
          
            // Construct the image path
            $imagePath = asset("public/assets/visual_stories/images/" . $this->attributes['story_image']);
        } else {
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getFileNameAttribute() {

        if (isset($this->attributes['story_image']) && !empty($this->attributes['story_image'])) {

            $image = $this->attributes['story_image'];
        } else {

            $image = "";
        }

        return $image;
    }
    
    function webstories_data(){
        return $this->hasMany('App\Models\WebstoriesData', 'visual_stories_id', 'id');
    }

    function category(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    
}
