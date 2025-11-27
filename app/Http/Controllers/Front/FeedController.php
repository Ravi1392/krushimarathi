<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Blog;
use App\Models\SpecialCategory;


class FeedController extends Controller {

    public function __construct() {
        
    }

    //blogs
    public function post_feed1() {

        $blogs = Blog::with('category:id,name')->select('id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'meta_description', 'is_active', 'updated_at')
                ->orderBy('id', 'desc')
                ->get();
        //  dd($blogs);   
        return response()->view('rssFeeds.post_feed1', ['blogs' => $blogs])
                ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }

    //Single Blog
    public function single_post_feed($blog_slug) {

        $blog = Blog::with('category:id,name')->select('id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'meta_description', 'is_active', 'updated_at')
                ->where('blog_slug', '=', $blog_slug)
                ->first();
        return response()->view('rssFeeds.single_post_feed', ['blog' => $blog])
                ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }

    public function single_category_all_post_feed($category_slug) {

        $category = Category::with(['blogs' => function ($query) {
                    $query->select('id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'meta_description', 'is_active', 'updated_at')
                    ->where('is_active',"=", 1)
                    ->orderBy('id', 'desc');
                }])
                ->select('id','name','category_slug','meta_description','is_active','updated_at')
                ->where('category_slug','=', $category_slug)
                ->where('is_active',"=", 1)
                ->first();

        return response()
            ->view('rssFeeds.single_category_all_post_feed', compact('category'))
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }

    public function single_sub_category_all_post_feed($sub_category_slug) {

        
        $sub_category = SubCategory::with(['blogs' => function ($query) {
                    $query->select('id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'meta_description', 'is_active', 'updated_at')
                    ->where('is_active',"=", 1)
                    ->orderBy('id', 'desc');
                },'category:id,category_slug'])
                ->select('id','name','category_id','subcategory_slug','meta_description','is_active','updated_at')
                ->where('subcategory_slug','=', $sub_category_slug)
                ->where('is_active',"=", 1)
                ->whereNull('deleted_at')
                ->first();

        return response()
            ->view('rssFeeds.single_sub_category_all_post_feed', compact('sub_category'))
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }
 
}
