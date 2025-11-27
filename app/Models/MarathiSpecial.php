<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarathiSpecial extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'krushi_marathi_specials';

    protected $appends = ['special_image','special_image_name'];

    public function getSpecialImageAttribute() {

        if (isset($this->attributes['special_image']) && !empty($this->attributes['special_image'])) {

            $imagePath = asset("/public/assets/admin/images/blog_image/" . $this->attributes['special_image']);
        } else {

            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getSpecialImageNameAttribute() {

        if (isset($this->attributes['special_image']) && !empty($this->attributes['special_image'])) {

            $image = $this->attributes['special_image'];
        } else {

            $image = "";
        }

        return $image;
    }

}
