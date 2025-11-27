<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsFlashData extends Model {

    use SoftDeletes;
    use HasFactory;
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'news_flash_data';
    
    protected $fillable = [
        'news_flash_id',
        'title',
    ];
}
