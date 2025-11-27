<?php

namespace App\Http\Controllers\Advertisement\SiteMaps;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Advertisement\Product;

class ProductSiteMapController extends Controller {

    public function __construct() {
        
    }

    public function ads_product_sitemap($number)
    {
        $limit = 1000;
        $offset = ($number - 1) * $limit;

        $products = Product::active()->select('id','slug','status','is_active','updated_at')->where('status', '=', 'Approved')->orderBy('id', 'asc')->offset($offset)->limit($limit)->get();

        if ($products->isEmpty()) {
            return response('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>', 200)
                ->header('Content-Type', 'application/xml; charset=UTF-8');
        }

        $viewName = "advertisement.sitemaps.ads_products_sitemap{$number}";

        return response()->view($viewName, compact('products'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
}
