<?php

namespace App\Models\Advertisement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model {

    use SoftDeletes;
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ads_wishlists';

    protected $fillable = [
        'customer_id',
        'product_id',
    ];
    
    function products(){
        return $this->hasMany('App\Models\Advertisement\Product', 'id', 'product_id');
    }
  
}