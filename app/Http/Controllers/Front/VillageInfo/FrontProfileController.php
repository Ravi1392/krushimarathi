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
use App\Models\VillageInfo\ProfilePoliticians;

class FrontProfileController extends Controller {
    
    use VillageTrait;

    public function __construct() {
        
    }

    public function profile($profile_slug){

        $profile = ProfilePoliticians::with(['profileposition:id,position_name,position_level', 'profilepoliticians' => function($query){
            $query->select('id','profile_politicians_id','party','constituency','from_date','to_date','portfolio','status')->orderBy('status', 'asc');
        }])->where('profile_slug',$profile_slug)->first();

        if(empty($profile) && !isset($profile)){
            return response()->view('frontend.errors.404_error', [], 404);
        }
        
        $blogs_for_row = $this->getInBlogs();

        $profile->increment('views');

        return view('frontend.villageinfo.profile',['profile' => $profile, 'blogs_for_row' => $blogs_for_row]);
    }
}
