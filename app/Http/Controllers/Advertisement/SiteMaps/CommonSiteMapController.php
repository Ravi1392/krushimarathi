<?php

namespace App\Http\Controllers\Advertisement\SiteMaps;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Advertisement\Category;
use App\Models\Advertisement\SubCategory;
use App\Models\Advertisement\Customer;


class CommonSiteMapController extends Controller {

    public function __construct() {
        
    }

    public function common_sitemap() {

        return response()
            ->view('advertisement.sitemaps.ads_common_sitemap')
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function ads_category_sitemap() {

        $ads_categories = Category::active()
                ->select('id','en_name','slug','is_active','updated_at')
                ->whereNull('deleted_at')
                ->orderBy('id','DESC')
                ->get();

        return response()
            ->view('advertisement.sitemaps.ads_category_sitemap', compact('ads_categories'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function ads_sub_category_sitemap() {

        $ads_sub_categories = SubCategory::active()->with('category:id,slug')
                ->select('id','ads_category_id','en_name','slug','is_active','updated_at')
                ->whereNull('deleted_at')
                ->orderBy('id','DESC')
                ->get();

        return response()
            ->view('advertisement.sitemaps.ads_sub_category_sitemap', compact('ads_sub_categories'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function customer_profile_sitemap($number)
    {
        $limit = 1000;
        $offset = ($number - 1) * $limit;

        $customers = Customer::active()->select('id','is_active','updated_at')->orderBy('id', 'asc')->offset($offset)->limit($limit)->get();

        if ($customers->isEmpty()) {
            return response('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>', 200)
                ->header('Content-Type', 'application/xml; charset=UTF-8');
        }

        $viewName = "advertisement.sitemaps.ads_customer_profile_sitemap{$number}";

        return response()->view($viewName, compact('customers'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
   
}
