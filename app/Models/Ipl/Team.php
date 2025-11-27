<?php

namespace App\Models\Ipl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ipl_teams';

    protected $fillable = ['en_teamname', 'shortname', 'img', 'matches', 'wins', 'loss', 'ties', 'nr'];

    protected $appends = ['img','img_name'];
    
    public function getImgAttribute() {

        if (isset($this->attributes['img']) && !empty($this->attributes['img'])) {

            $imagePath = asset("/public/assets/front/images/ipl/" . $this->attributes['img']);
        } else {

            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getImgNameAttribute() {

        if (isset($this->attributes['img']) && !empty($this->attributes['img'])) {

            $image = $this->attributes['img'];
        } else {

            $image = "";
        }

        return $image;
    }
    
}
