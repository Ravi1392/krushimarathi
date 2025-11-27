<?php

namespace App\Http\Controllers\Front\VillageInfo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SpecialCategory;
use App\Models\Country;
use App\Models\State;
use App\Models\District;
use App\Models\Taluka;
use App\Models\Village;
use App\Traits\VillageTrait;

class VillageInfoController extends Controller {
    
    use VillageTrait;

    public function __construct() {
        
    }
    
    public function index(){

        $spec_category_info = SpecialCategory::select('id', 'name', 'meta_keywords', 'views')->where('category_slug','=', 'in')->first();
            
        if(empty($spec_category_info) && !isset($spec_category_info)){
            return response()->view('frontend.errors.404_error', [], 404);
        }

        $country_data = Country::active()->with(['states' => function ($query) {
            $query->select('id','country_id','en_name','mr_name','state_slug','type','census_code','total_villages','is_active')->orderBy('is_active', 'desc');
        },'profilepoliticians' => function($query){
            $query->select('id','position_id','country_id','name','profile_slug','photo','status')
            ->where('status', '=', "current")
            ->orderBy('position_id', 'asc');
        },'profilepoliticians.profileposition:id,position_name,position_level'])
        ->where('code', '=', "IN")
        ->first();

        $other_countries = Country::active()->select('id','code','name','country_slug','is_active')
        ->where('code', '!=', "IN")
        ->get();
        
        $blogs_for_row = $this->getInBlogs();
        $sidebar_blogs = $this->getInSidebarBlogs();

        $spec_category_info->increment('views');

        return view('frontend.villageinfo.index',['spec_category_info' => $spec_category_info, 'country_data' => $country_data, 'other_countries' => $other_countries, 'blogs_for_row' => $blogs_for_row, 'sidebar_blogs' => $sidebar_blogs]);
    }

    public function country($country_slug){

        $spec_category_info = SpecialCategory::select('id', 'name', 'meta_keywords', 'views')->where('category_slug','=', 'in')->first();
            
        if(empty($spec_category_info) && !isset($spec_category_info)){
            return response()->view('frontend.errors.404_error', [], 404);
        }

        $spec_category_info->increment('views');

        $country_data = Country::active()->with(['states' => function ($query) {
            $query->select('id','country_id','en_name','mr_name','state_slug','type','census_code','total_villages','is_active')->orderBy('is_active', 'desc');
        },'profilepoliticians' => function($query){
            $query->select('id','position_id','country_id','name','profile_slug','photo','status')
            ->where('status', '=', "current")
            ->orderBy('position_id', 'asc');
        },'profilepoliticians.profileposition:id,position_name,position_level'])
        ->where('country_slug', '=', $country_slug)
        ->first();
        
        
        $other_countries = Country::active()->select('id','code','name','country_slug','is_active')
        ->where('country_slug', '!=', $country_slug)
        ->get();
        
        $blogs_for_row = $this->getInBlogs();
        $sidebar_blogs = $this->getInSidebarBlogs();

        $country_data->increment('views');

        return view('frontend.villageinfo.country',['spec_category_info' => $spec_category_info, 'country_data' => $country_data, 'other_countries' => $other_countries, 'blogs_for_row' => $blogs_for_row, 'sidebar_blogs' => $sidebar_blogs]);
    }

    public function state($state_slug){

        $state_data = State::active()->with(['districts' => function ($query) {
            $query->select('id','state_id','en_name','mr_name','district_slug','area','population','density','is_active')->orderBy('is_active', 'desc');
        }])->where('state_slug', '=', $state_slug)->first();
            
        if(empty($state_data) && !isset($state_data)){
            
            return back()->with(['error' => true, 'msg_value' => 'error', 'msg' => 'State data is not available yet. We’re working on it! Please revisit soon and explore other information on Krushi Marathi. Thank you!']);
        }
        
        $blogs_for_row = $this->getInBlogs();
        $sidebar_blogs = $this->getInSidebarBlogs();

        $state_data->increment('views');

        return view('frontend.villageinfo.state', ['state_data' => $state_data, 'blogs_for_row' => $blogs_for_row, 'sidebar_blogs' => $sidebar_blogs]);
    }

    public function district($district_slug){

        $district_data = District::active()->with(['state:id,en_name,mr_name,state_slug', 'talukas' => function ($query) {
            $query->select('id','district_id','en_name','mr_name','taluka_slug','area','population','density','total_villages','is_active')->orderBy('is_active', 'desc');
        }])->where('district_slug', '=', $district_slug)->first();
            
        if(empty($district_data) && !isset($district_data)){
            //return response()->view('frontend.errors.404_error', [], 404);
            return back()->with(['error' => true, 'msg_value' => 'error','msg' => 'District data is not available yet. We’re working on it! Please revisit soon and explore other information on Krushi Marathi. Thank you!']);
        }

        $district_data->increment('views');
        
        $blogs_for_row = $this->getInBlogs();
        $sidebar_blogs = $this->getInSidebarBlogs();

        return view('frontend.villageinfo.district', ['district_data' => $district_data, 'blogs_for_row' => $blogs_for_row, 'sidebar_blogs' => $sidebar_blogs]);
    }

    public function taluka($taluka_slug){

        $taluka_data = Taluka::active()->with(['district:id,state_id,en_name,district_slug', 'villages' => function ($query) {
            $query->select('id','taluka_id','en_name','mr_name','village_slug','gram_panchayat_name','panchayat_code','is_active')->orderBy('is_active', 'desc');
        }])->where('taluka_slug', '=', $taluka_slug)->first();
            
        if(empty($taluka_data) && !isset($taluka_data)){
            //return response()->view('frontend.errors.404_error', [], 404);
            return back()->with(['error' => true, 'msg_value' => 'error','msg' => 'Taluka data is not available yet. We’re working on it! Please revisit soon and explore other information on Krushi Marathi. Thank you!']);
        }

        $taluka_data->increment('views');
        
        $blogs_for_row = $this->getInBlogs();
        $sidebar_blogs = $this->getInSidebarBlogs();

        return view('frontend.villageinfo.taluka', ['taluka_data' => $taluka_data, 'blogs_for_row' => $blogs_for_row, 'sidebar_blogs' => $sidebar_blogs]);
    }

    public function village($village_slug){

        $village_data = Village::active()->with(['taluka:id,district_id,en_name,taluka_slug','villagestatistics:id,village_id,category_id,total,male,female','villagefacilities'])->where('village_slug', '=', $village_slug)->first();
            
        if(empty($village_data) && !isset($village_data)){
            // return response()->view('frontend.errors.404_error', [], 404);
            return back()->with(['error' => true, 'msg_value' => 'error','msg' => 'Village data is not available yet. We’re working on it! Please revisit soon and explore other information on Krushi Marathi. Thank you!']);
        }
        
        $blogs_for_row = $this->getInBlogs();
        $sidebar_blogs = $this->getInSidebarBlogs();

        $village_data->increment('views');

        return view('frontend.villageinfo.village', ['village_data' => $village_data, 'blogs_for_row' => $blogs_for_row, 'sidebar_blogs' => $sidebar_blogs]);
    }
    
    public function profile($profile_slug){
        return view('frontend.villageinfo.profile');
    }
}
