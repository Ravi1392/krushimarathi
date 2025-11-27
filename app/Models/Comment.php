<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    protected $fillable = ['blog_id', 'name', 'email', 'comment'];
    
    function blog(){
        return $this->hasOne('App\Models\Blog', 'id', 'blog_id');
    }
    
}
