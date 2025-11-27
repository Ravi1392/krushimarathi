<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialCategory extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'special_categories';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}
