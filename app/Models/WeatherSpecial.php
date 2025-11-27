<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeatherSpecial extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'weather_specials';
    
    protected $fillable = ['category_id', 'city_id', 'aqi_value', 'aqi_class', 'aqi_image', 'temperature', 'weather_condition', 'weather_image', 'is_active', 'created_at', 'updated_at'];

    protected $appends = ['aqi_image','aqi_image_name','weather_image','weather_image_name'];

    function district(){
        return $this->hasOne('App\Models\District', 'id', 'city_id');
    }

    public function getAqiImageAttribute() {

        if (isset($this->attributes['aqi_image']) && !empty($this->attributes['aqi_image'])) {

            $imagePath = asset("/public/assets/front/images/weather_images/" . $this->attributes['aqi_image']);
        } else {

            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getAqiImageNameAttribute() {

        if (isset($this->attributes['aqi_image']) && !empty($this->attributes['aqi_image'])) {

            $image = $this->attributes['aqi_image'];
        } else {

            $image = "";
        }

        return $image;
    }

    public function getWeatherImageAttribute() {

        if (isset($this->attributes['weather_image']) && !empty($this->attributes['weather_image'])) {

            $imagePath = asset("/public/assets/front/images/weather_images/" . $this->attributes['weather_image']);
        } else {

            $imagePath = "";
        }
    
        return $imagePath;
    }

    public function getWeatherImageNameAttribute() {

        if (isset($this->attributes['weather_image']) && !empty($this->attributes['weather_image'])) {

            $image = $this->attributes['weather_image'];
        } else {

            $image = "";
        }

        return $image;
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}
