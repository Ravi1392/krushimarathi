<?php

namespace App\Http\Controllers\Advertisement\SiteMaps;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Advertisement\Category;
use App\Models\Advertisement\SubCategory;
use App\Models\Advertisement\Customer;
use App\Models\Bajarbhav\BajarbhavSlug;


class BajarbhavSiteMapController extends Controller {

    public function __construct() {
        
    }

    public function bajarbhavSitemap() {
        
        $bajarbhav_sitemap = BajarbhavSlug::select('id','slug')->get();
        
        return response()
            ->view('advertisement.sitemaps.bajarbhav_sitemap', ['bajarbhav_sitemap' => $bajarbhav_sitemap])->header('Content-Type', 'application/xml; charset=UTF-8');
    }
  
}
