<?php

namespace App\Models\Advertisement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model {

    use SoftDeletes;
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ads_comments';

    function customer(){
        return $this->hasOne('App\Models\Advertisement\Customer', 'id', 'customer_id');
    }

    public function comment_replies()
    {
        return $this->hasMany('App\Models\Advertisement\CommentReply', 'comment_id', 'id');
    }
}