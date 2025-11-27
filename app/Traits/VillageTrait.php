<?php

namespace App\Traits;

use App\Models\Blog;
use Illuminate\Support\Facades\DB;

trait VillageTrait
{

    //It is for country, District, taluka, village page sidebar
    public function getInSidebarBlogs()
    {
        return Blog::select('id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active')
            ->whereIn('category_id', [30, 31, 33])
            ->where('is_active', 1)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
    }

    public function getInBlogs()
    {
        return Blog::select('id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active')
                ->where('is_active', '=', 1)
                ->whereIn('category_id', [30, 31, 33])
                ->orderBy('id', 'desc')
                ->skip(4)
                ->limit(6)
                ->get();
    }
}
