<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\LiveUpdate;
use App\Models\NewsFlash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CommonCronController extends Controller {

    public function __construct() {
        
    }
    
    public function live_update(){

        $dateSlug = strtolower(Carbon::now()->format('j-F-Y'));

        $url = "breaking-news-live-updates-{$dateSlug}";

        $check_slug = LiveUpdate::where('slug', '=', $url)->first();

        if(!isset($check_slug) && empty($check_slug)){
            // Insert into DB
            LiveUpdate::insert([
                    'user_id' => 1,
                    'slug' => $url,
                    'is_active'    => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'content_updated_at' => now()
                ]);
        }
        
    }
    
    public function news_flash(){

        $dateSlug = strtolower(Carbon::now()->format('j-F-Y'));

        $marathiUrl = "latest-breaking-news-in-marathi-{$dateSlug}";
        
        $mr_slug_check = NewsFlash::where('slug', '=', $marathiUrl)->first();
        
        if(!isset($mr_slug_check) && empty($mr_slug_check)){
            NewsFlash::insert([
                    'user_id' => 1,
                    'language_id'   => 1,
                    'slug' => $marathiUrl,
                    'is_active'    => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'content_updated_at' => now()
                ]);
        }

        $hindiUrl   = "latest-breaking-news-in-hindi-{$dateSlug}";
        
        $hi_slug_check = NewsFlash::where('slug', '=', $hindiUrl)->first();

        if(!isset($hi_slug_check) && empty($hi_slug_check)){
            NewsFlash::insert([
                    'user_id' => 1,
                    'language_id'   => 2,
                    'slug' => $hindiUrl,
                    'is_active'    => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'content_updated_at' => now()
                ]);
        }

        $englishUrl = "latest-breaking-news-in-english-{$dateSlug}";
        
        $en_slug_check = NewsFlash::where('slug', '=', $englishUrl)->first();

        if(!isset($en_slug_check) && empty($en_slug_check)){
            NewsFlash::insert([
                    'user_id' => 1,
                    'language_id'   => 3,
                    'slug' => $englishUrl,
                    'is_active'    => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'content_updated_at' => now()
                ]);
        }
    }

}
