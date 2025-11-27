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
use App\Models\Advertisement\ProductEnquiry;
use App\Models\MobileUser;
use App\Models\Blog;
use App\Traits\HasFilteredCategories;
use App\Traits\WishlistTrait;

class FrontController extends Controller {

    use HasFilteredCategories, WishlistTrait;

    public function __construct() {
        
    }

    //Home page code
    public function index(){
        $lang = session('locale', 'en');

        $stateColumn = getLocalizedColumn('states', $lang);
        $districtColumn = getLocalizedColumn('districts', $lang);

        $ads_categories = Category::active()
                ->select("id", "{$lang}_name as name", "slug")
                ->get();

        $ads_categories = $ads_categories->map(function ($ads_category) use ($lang, $stateColumn, $districtColumn) {
            $products = $ads_category->products()->active()
                ->where('language_code', $lang)
                ->orderBy('id', 'desc')
                ->limit(4)
                ->with([
                    "subcategory:id,{$lang}_name as name,slug",
                    "unit:id,{$lang}_name as name",
                    "state:id,{$stateColumn} as name",
                    "district:id,{$districtColumn} as name",

                    // Old Address (via customer)
                    'customer' => function ($q) use ($stateColumn, $districtColumn) {
                        $q->select('id', 'name', 'last_name', 'state_id', 'district_id')
                        ->with([
                            'state:id,' . $stateColumn . ' as name',
                            'district:id,' . $districtColumn . ' as name',
                        ]);
                    }
                ])
                ->get();

            $ads_category->setRelation('products', $products);
            return $ads_category;
        })->filter(function ($ads_category) {
            return $ads_category->products->isNotEmpty();
        })->values();

        $wishlistProductIds = $this->getCustomerWishlistProductIds();
        
        // $registeredUsersCount = formatNumberShort(Customer::count(), 1);
        $registeredUsersCount = formatNumberShort(5200, 1);
        $sellProductCount     = formatNumberShort(Product::where('lead_type', 0)->active()->count(), 1);
        $buyProductCount      = formatNumberShort(Product::where('lead_type', 1)->active()->count(), 1);
        // $mobileUsersCount     = formatNumberShort(MobileUser::count(), 1);
        $mobileUsersCount     = formatNumberShort(12500, 1);

        // dd($wishlistProductIds);
        
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
        //dd($blogs->toArray());
        
        return view('advertisement.index',[
            'ads_categories' => $ads_categories,
            'wishlistProductIds' => $wishlistProductIds,
            'registeredUsersCount' => $registeredUsersCount,
            'sellProductCount' => $sellProductCount,
            'buyProductCount' => $buyProductCount,
            'mobileUsersCount' => $mobileUsersCount,
            'blogs' => $blogs
        ]);
    }

    public function product_view($product_view){

        $lang = session('locale', 'en');

        $stateColumn = getLocalizedColumn('states', $lang);
        $districtColumn = getLocalizedColumn('districts', $lang);
        $talukaColumn = getLocalizedColumn('talukas', $lang);
        $villageColumn = getLocalizedColumn('villages', $lang);

        $product_data = Product::active()->status()
            ->withCount(['wishlists'])
            ->with([
                "category:id,{$lang}_name as name,slug",
                "subcategory:id,{$lang}_name as name,slug",
                "unit:id,{$lang}_name as name",
                "state:id,{$stateColumn} as name",
                "district:id,{$districtColumn} as name",
                "comments" => function ($q){
                    $q->select('id', 'customer_id', 'product_id', 'name', 'comment', 'is_active', 'created_at')
                    ->orderBy('created_at', 'desc');
                },
                'customer' => function ($q) use ($stateColumn, $districtColumn, $talukaColumn, $villageColumn, $lang) {
                    $q->select('id', 'name', 'last_name', 'middle_name', 'address', 'state_id', 'district_id', 'division_id', 'village_id', 'business_type_id', 'pincode', 'profile')
                        ->with([
                            "state:id,{$stateColumn} as name",
                            "district:id,{$districtColumn} as name",
                            "business_type:id,{$lang}_name as name",
                            "taluka:id,{$talukaColumn} as name",
                            "village:id,{$villageColumn} as name",
                        ]);
                }
            ])->where('slug','=',$product_view)->first();

        if($product_data){

            $related_product_data = Product::active()->status()
                ->withCount(['wishlists'])
                ->with([
                    "category:id,{$lang}_name as name,slug",
                    "subcategory:id,{$lang}_name as name,slug",
                    "unit:id,{$lang}_name as name",
                    "state:id,{$stateColumn} as name",
                    "district:id,{$districtColumn} as name",
                    'customer' => function ($q) use ($stateColumn, $districtColumn, $talukaColumn, $villageColumn, $lang) {
                        $q->select('id', 'name', 'last_name', 'middle_name', 'state_id', 'district_id')
                            ->with([
                                "state:id,{$stateColumn} as name",
                                "district:id,{$districtColumn} as name",
                            ]);
                    }
                ])
                ->where('category_id','=',$product_data->category_id)
                ->where('id','!=',$product_data->id)
                ->orderBy('id', 'desc')
                ->limit(8)
                ->get();

            $filtered_categories = $this->getFilteredCategories($lang);

            $product_data->increment('views');
            
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
            
            return view('advertisement.product_pages.product_view', [
                'product' => $product_data,
                'related_product_data' => $related_product_data,
                'filtered_categories' => $filtered_categories,
                'blogs' => $blogs
            ]);
        }else{
            return redirect()->route('ads.product.product_view', [$product_view])
                     ->with('error', __('You have reached an empty page, redirected to first page.'));
        }
        
    }

    public function sellProduct()
    {
        $lang = session('locale', 'en');

        $stateColumn = getLocalizedColumn('states', $lang);
        $districtColumn = getLocalizedColumn('districts', $lang);

        $ads_categories = Category::active()
                ->select("id", "{$lang}_name as name", "slug")
                ->get();

        $ads_categories = $ads_categories->map(function ($ads_category) use ($lang, $stateColumn, $districtColumn) {

            $products = $ads_category->products()->active()
                ->where('lead_type','=', 0)
                ->where('language_code', $lang)
                ->orderBy('id', 'desc')
                ->limit(4)
                ->with([
                    "subcategory:id,{$lang}_name as name,slug",
                    "unit:id,{$lang}_name as name",
                    "state:id,{$stateColumn} as name",
                    "district:id,{$districtColumn} as name",

                    // Old Address (via customer)
                    'customer' => function ($q) use ($stateColumn, $districtColumn) {
                        $q->select('id', 'name', 'last_name', 'state_id', 'district_id')
                        ->with([
                            'state:id,' . $stateColumn . ' as name',
                            'district:id,' . $districtColumn . ' as name',
                        ]);
                    }
                ])
                ->get();

            $ads_category->setRelation('products', $products);
            return $ads_category;
        })->filter(function ($ads_category) {
            return $ads_category->products->isNotEmpty();
        })->values();

        $wishlistProductIds = $this->getCustomerWishlistProductIds();
        
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
        //dd($blogs->toArray());

        return view('advertisement.product_pages.sell_product', [
            'ads_categories' => $ads_categories,
            'wishlistProductIds' => $wishlistProductIds,
            'blogs' => $blogs
        ]);
    }

    public function buyProduct()
    {
        $lang = session('locale', 'en');

        $stateColumn = getLocalizedColumn('states', $lang);
        $districtColumn = getLocalizedColumn('districts', $lang);

        $ads_categories = Category::active()
                ->select("id", "{$lang}_name as name", "slug")
                ->get();

        $ads_categories = $ads_categories->map(function ($ads_category) use ($lang, $stateColumn, $districtColumn) {

            $products = $ads_category->products()->active()
                ->where('lead_type','=', 1)
                ->where('language_code', $lang)
                ->orderBy('id', 'desc')
                ->limit(4)
                ->with([
                    "subcategory:id,{$lang}_name as name,slug",
                    "unit:id,{$lang}_name as name",
                    "state:id,{$stateColumn} as name",
                    "district:id,{$districtColumn} as name",

                    // Old Address (via customer)
                    'customer' => function ($q) use ($stateColumn, $districtColumn) {
                        $q->select('id', 'name', 'last_name', 'state_id', 'district_id')
                        ->with([
                            'state:id,' . $stateColumn . ' as name',
                            'district:id,' . $districtColumn . ' as name',
                        ]);
                    }
                ])
                ->get();

            $ads_category->setRelation('products', $products);
            return $ads_category;
        })->filter(function ($ads_category) {
            return $ads_category->products->isNotEmpty();
        })->values();

        $wishlistProductIds = $this->getCustomerWishlistProductIds();
        
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
        //dd($blogs->toArray());

        return view('advertisement.product_pages.buy_product', [
            'ads_categories' => $ads_categories,
            'wishlistProductIds' => $wishlistProductIds,
            'blogs' => $blogs
        ]);
    }

    public function sendEnquiry(Request $request){

        $enquiry = new ProductEnquiry();

        $enquiry->product_id = $request->product_id;
        $enquiry->enquiry_message = $request->enquiry_message;
        $enquiry->phone = $request->phone;
        $enquiry->save();

        if($enquiry){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'error']);
        }
    }
}
