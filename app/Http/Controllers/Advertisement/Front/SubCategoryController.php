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

class SubCategoryController extends Controller {

    use HasFilteredCategories, WishlistTrait;

    public function __construct() {
        
    }

    public function index($product_category,$product_sub_category){

        $lang = session('locale', 'en');

        $sub_category = SubCategory::active()
            ->select('id', 'slug', "{$lang}_name as name")
            ->where('slug', $product_sub_category)
            ->first();

        if (!$sub_category) {
            return redirect()->route('ads.product.product_category', $product_category)
            ->with('error', __('Sub Category not found, redirected to Category.'));
        }

        $filtered_categories = $this->getFilteredCategoriesWithSubcategories($lang);

        $stateColumn = getLocalizedColumn('states', $lang);
        $districtColumn = getLocalizedColumn('districts', $lang);

        $priceFilter = request()->get('price');
        $dateFilter = request()->get('date_range');

        $priceRanges = $priceFilter ? explode(',', $priceFilter) : [];
        $dateDays = $dateFilter ? explode(',', $dateFilter) : [];

        // Base query
        $productsQuery = Product::active()
            ->status()
            ->where('language_code', $lang)
            ->where('sub_category_id', $sub_category->id)
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
            ->select('id', 'customer_id', 'lead_type', 'language_code', 'category_id', 'sub_category_id', 'title', 'slug', 'unit_id', 'price', 'address_link', 'address', 'state_id', 'district_id', 'photo', 'views', 'created_at');

        // Apply filters
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

        $wishlistProductIds = $this->getCustomerWishlistProductIds();

        // Pagination
        $products = $productsQuery->latest('id')->paginate(1);
        
        if($products->isEmpty() && $products->currentPage() > 1) {

            return redirect()->route('ads.product.product_sub_category', [$product_category, $product_sub_category])
                     ->with('error', __('You have reached an empty page, redirected to first page.'));
        }
        
        $sub_category->increment('views');
        
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

        return view('advertisement.product_pages.sub_category_wise_product', [
            'products' => $products, 
            'sub_category' => $sub_category, 
            'filtered_categories' => $filtered_categories,
            'wishlistProductIds' => $wishlistProductIds,
            'blogs' => $blogs
        ]);
    }
}
