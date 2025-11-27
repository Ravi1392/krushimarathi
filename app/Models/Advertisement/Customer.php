<?php

namespace App\Models\Advertisement;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    protected $appends = ['file', 'file_name'];

    public function getFileAttribute() {

        if (isset($this->attributes['profile']) && !empty($this->attributes['profile'])) {
            $image = asset('/public/assets/advertisement/images/profile/'. $this->attributes['profile']);
        } else {

            $image = asset('/public/assets/advertisement/images/profile/default.png');
        }

        return $image;
    }

    public function getFileNameAttribute() {

        if (isset($this->attributes['profile']) && !empty($this->attributes['profile'])) {

            $image = $this->attributes['profile'];
        } else {

            $image = "";
        }

        return $image;
    }
    
    public function getFullNameAttribute()
    {
        return $this->name . ' ' .$this->middle_name . ' ' . $this->last_name;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    function business_type(){
        return $this->hasOne('App\Models\Advertisement\BusinessType', 'id', 'business_type_id');
    }

    function state(){
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }

    function district(){
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }

    function taluka(){
        return $this->hasOne('App\Models\Taluka', 'id', 'division_id');
    }

    function village(){
        return $this->hasOne('App\Models\Village', 'id', 'village_id');
    }

    function products(){
        return $this->hasMany('App\Models\Advertisement\Product', 'customer_id', 'id');
    }

}
