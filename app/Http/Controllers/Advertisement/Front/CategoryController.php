<?php

namespace App\Http\Controllers\Advertisement\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Advertisement\Category;
use App\Models\Advertisement\Unit;
use App\Models\Advertisement\BusinessType;
use App\Models\Advertisement\Customer;
use App\Models\Advertisement\Product;
use App\Models\Advertisement\SubCategory;
use App\Traits\HasFilteredCategories;
use App\Traits\WishlistTrait;
use App\Models\Blog;

class CategoryController extends Controller {

    use HasFilteredCategories, WishlistTrait;

    public function __construct() {
        
    }

    public function index($product_category)
    {
        $lang = session('locale', 'en');

        $category = Category::active()
            ->select('id', 'slug')
            ->where('slug', $product_category)
            ->first();

        if (!$category) {
            return redirect('/ads')->with('error', __('Category not found'));
        }

        $filtered_categories = $this->getFilteredCategoriesWithSubcategories($lang);

        $stateColumn = getLocalizedColumn('states', $lang);
        $districtColumn = getLocalizedColumn('districts', $lang);

        $priceFilter = request()->get('price');
        $dateFilter = request()->get('date_range');

        $priceRanges = $priceFilter ? explode(',', $priceFilter) : [];
        $dateDays = $dateFilter ? explode(',', $dateFilter) : [];

        $subcategories = SubCategory::active()
            ->select("id", "{$lang}_name as name", "slug", "ads_category_id")
            ->where('ads_category_id', $category->id)
            ->get();

        $subcategories = $subcategories->map(function ($subcategory) use ($lang, $stateColumn, $districtColumn, $priceRanges, $dateDays) {
            $productsQuery = $subcategory->products()
                ->active()->status()
                ->where('language_code', $lang)
                ->select('id', 'customer_id', 'lead_type', 'language_code', 'category_id', 'sub_category_id', 'title', 'slug', 'unit_id', 'price', 'address_link', 'address', 'state_id', 'district_id', 'photo', 'views', 'created_at');

            if (!empty($priceRanges)) {
                $productsQuery->where(function ($q) use ($priceRanges) {
                    foreach ($priceRanges as $range) {
                        if ($range == 'below_499') {
                            $q->orWhere('price', '<', 499);
                        } elseif ($range == 'above_5000') {
                            $q->orWhere('price', '>', 5000);
                        } else {
                            [$min, $max] = explode('_', $range);
                            $q->orWhereBetween('price', [(float)$min, (float)$max]);
                        }
                    }
                });
            }

            if (!empty($dateDays)) {
                $productsQuery->where(function ($q) use ($dateDays) {
                    foreach ($dateDays as $days) {
                        $q->orWhere('created_at', '>=', now()->subDays((int)$days));
                    }
                });
            }

            $products = $productsQuery
                ->orderBy('id', 'desc')
                ->limit(4)
                ->with([
                    "category:id,{$lang}_name as name,slug",
                    "unit:id,{$lang}_name as name",
                    "state:id,{$stateColumn} as name",
                    "district:id,{$districtColumn} as name",
                    'customer' => function ($q) use ($stateColumn, $districtColumn) {
                        $q->select('id', 'name', 'last_name', 'address', 'state_id', 'district_id')
                            ->with([
                                "state:id,{$stateColumn} as name",
                                "district:id,{$districtColumn} as name",
                            ]);
                    }
                ])
                ->get();

            $subcategory->setRelation('products', $products);
            return $subcategory;
        })->filter(function ($subcategory) {
            return $subcategory->products->isNotEmpty();
        })->values();

        $wishlistProductIds = $this->getCustomerWishlistProductIds();
        
        $category->increment('views');
        
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

        return view('advertisement.product_pages.category_wise_product', [
            'category' => $category,
            'subcategories' => $subcategories,
            'filtered_categories' => $filtered_categories,
            'wishlistProductIds' => $wishlistProductIds,
            'blogs' => $blogs
        ]);
    }

}
