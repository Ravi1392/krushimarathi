<?php

namespace App\Http\Controllers\Front\VillageInfo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\District;
use App\Models\Taluka;
use App\Models\Village;
use App\Models\VillageInfo\ProfilePoliticians;


class VillageSiteMapController extends Controller {

    public function __construct() {
        
    }

    public function country_sitemap() {

        return response()
            ->view('frontend.villageinfo.sitemaps.country_sitemap')
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function state_sitemap() {

        $states = State::select('id','en_name','state_slug','is_active','content_updated_at')
                ->where('is_active',1)
                ->whereNull('deleted_at')
                ->orderBy('id','DESC')
                ->get();

        return response()
            ->view('frontend.villageinfo.sitemaps.state_sitemap', compact('states'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function district_sitemap() {

        $districts = District::select('id','en_name','district_slug','is_active','content_updated_at')
                ->where('is_active',1)
                ->whereNull('deleted_at')
                ->orderBy('id','DESC')
                ->get();

        return response()
            ->view('frontend.villageinfo.sitemaps.district_sitemap', compact('districts'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
    public function taluka_sitemap($number)
    {
        $limit = 1000;
        $offset = ($number - 1) * $limit;
    
        $talukas = Taluka::select('id', 'taluka_slug', 'is_active', 'content_updated_at')
            ->where('is_active', 1)
            ->orderBy('id', 'asc') // ✅ ascending for stable sitemap
            ->offset($offset)
            ->limit($limit)
            ->get();
    
        if ($talukas->isEmpty()) {
            return response('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>', 200)
                ->header('Content-Type', 'application/xml; charset=UTF-8');
        }
    
        $viewName = "frontend.villageinfo.sitemaps.taluka_sitemap{$number}";
    
        return response()->view($viewName, compact('talukas'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
    // Profile Politicians
    public function profile_politicians_sitemap1(){
        $profile_politicians = ProfilePoliticians::select('id','profile_slug','updated_at')
                ->orderBy('id', 'desc')
                ->limit(1000)
                ->get();
            
        return response()->view('frontend.villageinfo.sitemaps.profile_politicians_sitemap1', compact('profile_politicians'))->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
}
