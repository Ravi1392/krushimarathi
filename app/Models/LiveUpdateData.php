<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LiveUpdateData extends Model {

    use SoftDeletes;
    use HasFactory;
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'live_update_data';
    
    protected $fillable = [
        'live_update_id',
        'title',
        'description',
    ];
}
