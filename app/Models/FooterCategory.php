<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FooterCategory extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'footer_categories';
    
    protected $casts = [
        'content_updated_at' => 'datetime',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
  
}
