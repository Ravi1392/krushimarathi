<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsFlash extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news_flashs';
    
    protected $fillable = [
        'user_id',
        'language_id',
        'slug',
        'content_updated_at',
        'views',
        'is_active'
    ];

    protected $appends = ['news_flash_image','news_flash_image_name'];
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];

    public function getNewsFlashImageAttribute() {

        return asset("/public/news_flash.webp");
    }

    public function getNewsFlashImageNameAttribute() {


        return "news_flash.webp";
    }

    function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    function newsflashsdata(){
        return $this->hasMany('App\Models\NewsFlashData', 'news_flash_id', 'id')->orderBy('id', 'desc');
    }
    
    function newsflashdata(){
        return $this->hasOne('App\Models\NewsFlashData', 'news_flash_id', 'id')->orderBy('id', 'desc');
    }

}
