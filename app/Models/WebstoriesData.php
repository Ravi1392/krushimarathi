<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebstoriesData extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'visual_stories_data';
    
    protected $fillable = [
        'visual_stories_id',
        'value',
        'story_title',
        'story_description',
        'file_data',
        'image_credit'
    ];
    
    protected $appends = ['file', 'file_name'];

    public function getFileAttribute() {
        if (isset($this->attributes['file_data']) && !empty($this->attributes['file_data'])) {
            // Use the created_at date to get the year, month, and day
            $uploadDate = $this->attributes['created_at'];
            
            $year = Date("Y", strtotime($uploadDate));
            $month = Date("m", strtotime($uploadDate));
            $day = Date("d", strtotime($uploadDate));
    
            // Construct the image path
            $imagePath = asset("/public/assets/visual_stories/images/web_stories/{$year}/{$month}/{$day}/" . $this->attributes['file_data']);
        } else {
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getFileNameAttribute() {

        if (isset($this->attributes['file_data']) && !empty($this->attributes['file_data'])) {

            $image = $this->attributes['file_data'];
        } else {

            $image = "";
        }

        return $image;
    }
    
}
