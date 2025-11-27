<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Blog;
use App\Models\User;
use App\Models\Webstories;
use App\Models\SpecialCategory;
use App\Models\LiveUpdate;
use App\Models\NewsFlash;

class SiteMapController extends Controller {

    public function __construct() {
        
    }
    
    public function sitemap_index(){
        return response()->view('sitemaps.sitemap_index')->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function category_sitemap() {

        $categories = Category::
                select('id','category_slug','is_active','content_updated_at')
                ->where('is_active',1)
                ->orderBy('id','DESC')
                ->get();

        return response()
            ->view('sitemaps.category_sitemap', compact('categories'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function subCategory_sitemap1() {

        $sub_categories = SubCategory::with('category:id,category_slug')
                ->select('id','category_id','subcategory_slug','is_active','content_updated_at')
                ->where('is_active',1)
                ->whereNull('deleted_at')
                ->orderBy('id','DESC')
                ->get();

        return response()
            ->view('sitemaps.sub_categories1', compact('sub_categories'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function page_sitemap(){

        $footercategories = DB::table('footer_categories')
                ->select('id','category_slug','is_active','content_updated_at','deleted_at')
                ->where('is_active', '=',1)
                ->orderBy('id','ASC')
                ->get();
        
        return response()
            ->view('sitemaps.page_sitemap', compact('footercategories'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
    public function post_sitemap1() {

        $blogs = Blog::select('id','blog_slug','is_active','content_updated_at')
                ->where('is_active', '=',1)
                ->orderBy('id', 'desc')
                ->limit(1000)
                ->get();
            
        return response()->view('sitemaps.post_sitemap1', ['blogs' => $blogs])->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
    public function post_images_sitemap1() {

        $blog_images = Blog::select('id','blog_slug','blog_title','blog_image','is_active','content_updated_at')
                ->where('is_active', '=',1)
                ->orderBy('id', 'desc')
                ->limit(1000)
                ->get();
            
        return response()->view('sitemaps.post_sitemap_images1', ['blogs' => $blog_images])->header('Content-Type', 'application/xml; charset=UTF-8');
    } 
    
    public function webstories_sitemap1(){
        $webstories = Webstories::select('id','slug','is_active','content_updated_at')
                ->orderBy('id', 'desc')
                ->limit(1000)
                ->get();
        
        return response()
            ->view('sitemaps.webstories_sitemap', compact('webstories'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
    public function special_category_sitemap(){

        $special_categories = SpecialCategory::select('id','category_slug','is_active','content_updated_at')
                ->where('is_active',1)
                ->orderBy('id','DESC')
                ->get();
        return response()
            ->view('sitemaps.special_category_sitemap', compact('special_categories'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
    public function author_sitemap(){
        
        $authers = User::select('id','username','is_active','updated_at')
        ->where('is_active',1)
        ->orderBy('id','DESC')
        ->get();

        return response()
        ->view('sitemaps.author_sitemap', compact('authers'))
        ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function news_sitemap() {

        $blogs = Blog::with(['category:id,category_slug'])->select('id','category_id','blog_slug','blog_title','is_active','content_updated_at','created_at')
                ->where('created_at', '>=', now()->subDays(2))
                ->where('is_active', '=',1)
                ->orderBy('id', 'desc')
                ->limit(1000)
                ->get();
            
        return response()->view('sitemaps.news_sitemap', ['blogs' => $blogs])->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
    public function live_update_sitemap1() {

        $live_update = LiveUpdate::select('id','slug','is_active','content_updated_at')
                ->where('is_active', '=',1)
                ->orderBy('id', 'desc')
                ->limit(1000)
                ->get();
            
        return response()->view('sitemaps.live_update_sitemap1', ['live_updates' => $live_update])->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
    public function news_flash_sitemap1() {

        $news_flashs = NewsFlash::select('id','slug','is_active','content_updated_at')
                ->where('is_active', '=',1)
                ->orderBy('id', 'desc')
                ->limit(1000)
                ->get();
            
        return response()->view('sitemaps.news_flash_sitemap1', ['news_flashs' => $news_flashs])->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
    
}
