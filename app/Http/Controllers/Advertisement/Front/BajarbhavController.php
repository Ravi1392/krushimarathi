<?php

namespace App\Http\Controllers\Advertisement\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SpecialCategory;
use App\Models\Blog;

class BajarbhavController extends Controller {

    public function __construct() {
        
    }

    public function bajarbhav()
    {
        $lang = session('locale', 'en');

        SpecialCategory::where('id', 3)->increment('views');

        //blog list
        $languageCategoryMap = [
            'mr' => [6, 22, 23, 24, 25, 26, 27, 28],
            'hi' => [30, 31],
            'en' => [33]
        ];
        
        $categoryIds = $languageCategoryMap[$lang] ?? [33];

        $blogs = Blog::active()->with(['category:id,category_slug',
                    'subcategory:id,subcategory_slug',
                    'blogimages:id,blog_id,cropped_image,width,created_at'
                ])
                ->select('id','category_id','sub_category_id','blog_title','blog_slug','blog_image','is_active')
                ->whereIn('category_id', $categoryIds)
                ->orderBy('id', 'desc')
                ->limit(8)
                ->get();
        
        return view('advertisement.bajarbhav.bajarbhav_menu', ['blogs' => $blogs]);
    }
}
