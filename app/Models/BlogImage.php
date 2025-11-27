<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogImage extends Model {

    use SoftDeletes;
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_images';
    

    // Add the attributes you want to allow for mass assignment
    protected $fillable = [
        'blog_id',
        'original_image',
        'cropped_image',
        'width',
        'height'
    ];

    protected $appends = ['file', 'file_name'];

    public function getFileAttribute() {
        if (isset($this->attributes['cropped_image']) && !empty($this->attributes['cropped_image'])) {
            // Use the created_at date to get the year, month, and day
            $uploadDate = $this->attributes['created_at'];
            
            $year = Date("Y", strtotime($uploadDate));
            $month = Date("m", strtotime($uploadDate));
            $day = Date("d", strtotime($uploadDate));
    
            // Construct the image path
            $imagePath = asset("/public/assets/admin/images/blog_image/{$year}/{$month}/{$day}/" . $this->attributes['cropped_image']);
        } else {
            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getFileNameAttribute() {

        if (isset($this->attributes['cropped_image']) && !empty($this->attributes['cropped_image'])) {

            $image = $this->attributes['cropped_image'];
        } else {

            $image = "";
        }

        return $image;
    }
  
}
