<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\WeatherSpecial;
use App\Models\District;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Village;
use App\Models\Blog;
use App\Models\Subscriber;
use Mail;

class WeatherCronController extends Controller {

    public function __construct() {
        
    }
    
    public function weather_update(){

        $districts = District::select('id','latitude','longitude')->where('state_id','=',14)->get();
        Log::info('Cron job start');
        foreach ($districts as $district) {
            $temperatureData = $this->getTemperature($district->latitude, $district->longitude);

            if ($temperatureData) {
                $aqiData = $this->getOzone($district->latitude, $district->longitude);

                if ($aqiData) {
                    WeatherSpecial::updateOrCreate(
                        ['city_id' => $district->id],
                        [
                            'aqi_value' => $aqiData['aqi_value'],
                            'aqi_class' => $aqiData['aqi_class'],
                            'aqi_image' => $aqiData['aqi_image'],
                            'temperature' => $temperatureData['temperature'],
                            'weather_condition' => $temperatureData['weather_condition'],
                            'weather_image' => $temperatureData['weather_image'],
                        ]
                    );
                }
            }
        }
        Log::info('Cron job end');
    }

    private function getTemperature($latitude, $longitude)
    {
        $url = "https://api.open-meteo.com/v1/forecast?latitude={$latitude}&longitude={$longitude}&current=temperature_2m,weather_code";
        $response = Http::get($url);

        if ($response->successful() && isset($response['current']['temperature_2m'])) {
            $data = $response->json();
            $weather = $this->mapWeatherCode($data['current']['weather_code'] ?? null);

            return [
                'temperature' => $data['current']['temperature_2m'] ?? null,
                'weather_condition' => $weather['weather_condition'],
                'weather_image' => $weather['weather_image']
            ];
        }

        return null;
    }

    private function getOzone($latitude, $longitude)
    {
        $url = "https://air-quality-api.open-meteo.com/v1/air-quality?latitude={$latitude}&longitude={$longitude}&current=ozone";
        $response = Http::get($url);

        if ($response->successful() && isset($response['current']['ozone'])) {
            $data = $response->json();
            $aqiValue = $data['current']['ozone'] ?? null;
            $aqiStatus = $this->mapAqiStatus($aqiValue);

            return [
                'aqi_value' => $aqiValue,
                'aqi_class' => $aqiStatus['aqi_class'],
                'aqi_image' => $aqiStatus['aqi_image']
            ];
        }

        return null;
    }


    private function mapWeatherCode($code)
    {
        if ($code == 0 || $code == 1) {
            return ['weather_condition' => 'CLEAR', 'weather_image' => 'clear.webp'];
        } elseif (in_array($code, [2])) {
            return ['weather_condition' => 'CLOUDS', 'weather_image' => 'clouds.webp'];
        } elseif (in_array($code, [3, 45, 48])) {
            return ['weather_condition' => 'CLOUDS', 'weather_image' => 'clouds_2.webp'];
        } elseif (($code >= 51 && $code <= 67)) {
            return ['weather_condition' => 'RAIN', 'weather_image' => 'rain.webp'];
        } elseif (($code >= 71 && $code <= 77)) {
            return ['weather_condition' => 'SNOW', 'weather_image' => 'snow.webp'];
        } elseif (($code >= 80 && $code <= 99)) {
            return ['weather_condition' => 'THUNDERSTORM', 'weather_image' => 'rain.webp'];
        } else {
            return ['weather_condition' => 'UNKNOWN', 'weather_image' => 'clouds_2.webp'];
        }
    }
    
    private function mapAqiStatus($aqi)
    {
        if ($aqi >= 0 && $aqi <= 50) {
            return ['aqi_class' => 'good', 'aqi_image' => 'good.webp'];
        } elseif ($aqi >= 51 && $aqi <= 100) {
            return ['aqi_class' => 'moderate', 'aqi_image' => 'moderate.webp'];
        } elseif ($aqi >= 101 && $aqi <= 150) {
            return ['aqi_class' => 'poor', 'aqi_image' => 'poor.webp'];
        } elseif ($aqi >= 151 && $aqi <= 200) {
            return ['aqi_class' => 'unhealthy', 'aqi_image' => 'unhealthy.webp'];
        } elseif ($aqi >= 201 && $aqi <= 250) {
            return ['aqi_class' => 'unhealthy', 'aqi_image' => 'unhealthy.webp'];
        } else {
            return ['aqi_class' => 'hazardous', 'aqi_image' => 'hazardous.webp'];
        }
    }
    
    public function fixDuplicateSlugs()
    {
        $villages = Village::orderBy('village_slug')->get();

        $existingSlugs = [];

        foreach ($villages as $village) {
            $originalSlug = $village->village_slug;
            $slug = $originalSlug;
            $i = 1;

            // Already seen slug, generate new one
            while (in_array($slug, $existingSlugs)) {
                $slug = $originalSlug . '-' . $i;
                $i++;

                // Limit to 50 variations
                if ($i > 50) break;
            }

            // Update slug if changed
            if ($slug !== $originalSlug) {
                $village->village_slug = $slug;
                $village->save();
            }

            $existingSlugs[] = $slug;
        }

        return response()->json(['message' => 'Village slugs fixed successfully']);
    }
    
    public function cron_test(){
        Log::info('Cron job working');
    }
    
    public function sendNewsletter()
    { 
        Log::info('Newsletter Cron job start');
        $blogs = Blog::active()->with(['category:id,category_slug',
                    'subcategory:id,subcategory_slug',
                    'blogimages:id,blog_id,cropped_image,width,created_at'
                ])
                ->select('id','category_id','sub_category_id','blog_title','blog_slug','blog_image','meta_description','is_active')
                ->orderBy('id', 'desc')
                ->limit(5)
                ->get();

        $subscribers = Subscriber::pluck('email')->toArray();

        foreach ($subscribers as $email) {
            Mail::send('emails.newsletter', ['blogs' => $blogs], function ($message) use ($email) {
                $message->to($email)->subject('Krushi - Daily Updates for You');
            });
            Log::info('Newsletter mail Send');
        }

        //return 'Newsletter sent successfully!';
        Log::info('Newsletter Cron job end');
    }
    
}
