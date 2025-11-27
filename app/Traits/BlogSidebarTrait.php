<?php

namespace App\Traits;

use App\Models\Blog;
use App\Models\Category;
use App\Models\NewsFlash;
use App\Models\FooterCategory;
use Illuminate\Support\Facades\DB;

trait BlogSidebarTrait
{
    public function getSidebarBlogs($categorySlug, $excludedBlogId = null, $sub_category_info_id = null)
    {

        return Blog::with([
                'category:id,name,category_slug',
                'subcategory:id,subcategory_slug'
            ])
            ->select('id', 'user_id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at')
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('category_slug', $categorySlug);
            })
            ->when(isset($excludedBlogId), function ($query) use ($excludedBlogId) {
                return $query->where('id', '!=', $excludedBlogId);
            })
            ->when(isset($sub_category_info_id), function ($query) use ($sub_category_info_id) {
                return $query->where('sub_category_id', '!=', $sub_category_info_id);
            })
            // ->whereNotIn('category_id', [33])
            ->where('is_active', 1)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
    }

    public function getFooterCategory($categorySlug)
    {
        return FooterCategory::select('id','name','category_slug','meta_description','meta_keywords','views','is_active','created_at','updated_at')
                ->where('category_slug', $categorySlug)
                ->where('is_active', '=',1)
                ->first();
    }
    
    //It is for Seach bar and Tag time given function work also weather page
    public function getSearchSidebarBlogs()
    {
        return Blog::select('id', 'blog_title', 'blog_slug', 'blog_image', 'is_active')
        ->where('is_active', 1)
        ->orderBy('id', 'desc')
        ->limit(4)
        ->get();
    }
    
    //It is for home page sidebar
    public function getHomeSidebarBlogs()
    {
        return Blog::select('id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active')
        // ->whereNotIn('category_id', [33, 34])
        ->where('is_active', 1)
        ->orderBy('id', 'desc')
        ->skip(2)
        ->limit(3)
        ->get();
    }
    
    public function incrementCount($category_id,$category_views){
        Category::where('id', $category_id)
                ->withTrashed()
                ->update(['views' => $category_views + 1]);
    }
    
    public function incrementFooterMenuCount($category_id,$category_views){
        FooterCategory::where('id', $category_id)
                ->withTrashed()
                ->update(['views' => $category_views + 1]);
    }
    
    public function getFooterSidebarBlogs(){
        return Blog::select('id', 'user_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at')
        ->where('is_active', 1)
        ->inRandomOrder()
        ->limit(4)
        ->get();
    }
    
    // Query 1: Fetch Blogs with Views Between 0 to 5

    public function getHomeSidebarBlogs1()
    {
        return Blog::select('id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'views', 'is_active')
        // ->whereNotIn('category_id', [33, 34])
        ->where('views','>=', 0)
        ->where('views','<=', 100)
        ->where('is_active', 1)
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();
    }

    // Query 1: Fetch Blogs with Views Between 6 to 12

    public function getHomeSidebarBlogs2()
    {
        return Blog::select('id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'views', 'is_active')
        // ->whereNotIn('category_id', [33, 34])
        ->where('views','>=', 101)
        ->where('views','<=', 150)
        ->where('is_active', 1)
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();
    }

    // Query 1: Fetch Blogs with Views Between 13 to 30

    public function getHomeSidebarBlogs3()
    {
        return Blog::select('id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'views', 'is_active')
        // ->whereNotIn('category_id', [33, 34])
        ->where('views','>=', 151)
        ->where('views','<=', 250)
        ->where('is_active', 1)
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();
    }
    
    //News Flash content for Marathi, Hindi and English

    public function getNewsFlash($language_id)
    {
        return NewsFlash::with([
            'newsflashsdata' => function($query) {
                $query->orderBy('id', 'desc')
                    ->limit(5);
            }
        ])
        ->where('language_id', $language_id)
        ->where('is_active', 1)
        ->orderBy('id', 'desc')
        ->first();
    }
    
    //The MarketDesk data
    public function getMarketDesk()
    {
        return DB::connection('marketdesk_mysql')->table('blogs')->select('id', 'blog_title', 'blog_slug', 'is_active')
        ->where('is_active', 1)
        ->orderBy('id', 'desc')
        ->limit(12)
        ->get();
    }
    
}
