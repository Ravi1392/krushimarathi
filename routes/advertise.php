<?php

use Illuminate\Support\Facades\Route;

//Admin Side
use App\Http\Controllers\Advertisement\Admin\CustomerController;
use App\Http\Controllers\Advertisement\Admin\DashboardController;
use App\Http\Controllers\Advertisement\Admin\ManageProductController;

//Front Side
use App\Http\Controllers\Advertisement\Front\FrontController;
use App\Http\Controllers\Advertisement\Front\CategoryController;
use App\Http\Controllers\Advertisement\Front\SubCategoryController;
use App\Http\Controllers\Advertisement\Front\BajarbhavController;
use App\Http\Controllers\Advertisement\Front\BajarbhavDataController;

//Common
use App\Http\Controllers\Advertisement\Common\CustomerAuth;
use App\Http\Controllers\Advertisement\Common\CommonController;
use App\Http\Controllers\Advertisement\Common\ProductController;
use App\Http\Controllers\Advertisement\Common\WishlistController;
use App\Http\Controllers\Advertisement\Common\CommentController;

//Sitemap
use App\Http\Controllers\Advertisement\SiteMaps\CommonSiteMapController;
use App\Http\Controllers\Advertisement\SiteMaps\ProductSiteMapController;
use App\Http\Controllers\Advertisement\SiteMaps\BajarbhavSiteMapController;


Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'hi', 'mr'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
});

//Sitemaps
Route::get('/ads-category-sitemap.xml', [CommonSiteMapController::class, 'ads_category_sitemap']);
Route::get('/ads-sub-category-sitemap.xml', [CommonSiteMapController::class, 'ads_sub_category_sitemap']);
Route::get('/ads-common-sitemap.xml', [CommonSiteMapController::class, 'common_sitemap']);
Route::get('/customer-profile-sitemap{number}.xml', [CommonSiteMapController::class, 'customer_profile_sitemap'])
    ->where('number', '[0-9]+');
Route::get('/ads-product-sitemap{number}.xml', [ProductSiteMapController::class, 'ads_product_sitemap'])
    ->where('number', '[0-9]+');
Route::get('/sitemap-bajarbhav.xml', [BajarbhavSiteMapController::class, 'bajarbhavSitemap']);

Route::get('/', [FrontController::class, 'index'])->name('ads');
Route::get('/SendTestEmail', [CommonController::class, 'SendTestEmail']);

Route::get('/login', [CustomerAuth::class, 'showLoginForm'])->name('ads.loginForm');
Route::post('/login', [CustomerAuth::class, 'login'])->name('ads.login');
Route::get('/verifyPhoneNo', [CustomerAuth::class, 'verifyPhoneNo'])->name('ads.login.verifyPhoneNo');
Route::get('/register', [CustomerAuth::class, 'showRegisterForm'])->name('ads.register');
Route::post('/saveCustomer', [CustomerAuth::class, 'saveCustomer'])->name('ads.saveCustomer');
Route::get('/phoneCheck', [CustomerAuth::class, 'phoneCheck'])->name('ads.register.phoneCheck');
Route::get('/emailCheck', [CustomerAuth::class, 'emailCheck'])->name('ads.register.emailCheck');

//Product add without Signin and Login
Route::get('/post-advertisement', [ProductController::class, 'AdvertisementForm'])->name('ads.post-advertisement');
Route::post('/saveProduct', [ProductController::class, 'saveProduct'])->name('ads.saveProduct');

Route::get('/districts/{state_id}', [CommonController::class, 'getDistricts'])->name('ads.districts');
Route::get('/talukas/{district_id}', [CommonController::class, 'getTalukas'])->name('ads.talukas');
Route::get('/villages/{taluka_id}', [CommonController::class, 'getVillages'])->name('ads.villages');
Route::get('/sub-categories/{category_id}', [CommonController::class, 'getSubCategories'])->name('ads.sub-categories');
Route::get('/profile/{customer_id}', [CommonController::class, 'customerProfile'])->name('ads.profile');

//Sell and Buy Products

Route::get('/sell', [FrontController::class, 'sellProduct'])->name('ads.sell');
Route::get('/buy', [FrontController::class, 'buyProduct'])->name('ads.buy');

//Bajarbhav Routes
Route::get('/todays-bajarbhav', [BajarbhavController::class, 'bajarbhav'])->name('ads.todays-bajarbhav');
Route::get('/{commodityCode}/{cropName}-bajar-bhav-today', [BajarbhavDataController::class, 'showCropBajarbhav'])
    ->where([
        'commodityCode' => '[0-9]+',
        'cropName' => '[a-zA-Z0-9\-]+',
    ])
    ->name('ads.bajarbhav.crop');

Route::get('/city/{cityCode}/{cityName}-bajar-bhav-today', [BajarbhavDataController::class, 'showCityBajarbhav'])
    ->where([
        'cityCode' => '[0-9]{2}',
        'cityName' => '[a-zA-Z0-9\-]+',
    ])
    ->name('ads.bajarbhav.city');

Route::get('/samiti/{bajarSamitiCode}/{bajarSamitiName}-bajar-bhav-today', [BajarbhavDataController::class, 'showbajarSamitiBajarbhav'])
    ->where([
        'bajarSamitiCode' => '[0-9]+',
        'bajarSamitiName' => '[a-zA-Z0-9\-]+',
    ])
    ->name('ads.bajarbhav.samiti');

Route::get('/blogs', [CommonController::class, 'getBlogs'])->name('ads.blogs');

Route::group(['prefix' => 'product'], function () {
    Route::get('/{product_category}', [CategoryController::class, 'index'])
        ->where('product_category', '[a-zA-Z0-9\-]{5,28}')
        ->name('ads.product.product_category');

    Route::get('/{product_category}/{product_sub_category}', [SubCategoryController::class, 'index'])
        ->name('ads.product.product_sub_category');

    Route::get('/{product_view}', [FrontController::class, 'product_view'])
        ->where('product_view', '[a-zA-Z0-9\-]{29,}')
        ->name('ads.product.product_view');

    Route::post('/send-enquiry', [FrontController::class, 'sendEnquiry'])
        ->name('ads.product.send-enquiry');
    
    Route::post('/send-comment', [CommentController::class, 'addComment'])
        ->name('ads.product.send-comment');
    
    Route::post('/send-requirement', [CommonController::class, 'addRequirement'])
        ->name('ads.product.send-requirement');
});

Route::middleware(['auth:customer', 'customer.verified'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('ads.dashboard');

    //verify account
    Route::post('/verifyOtp', [CustomerController::class, 'verifyOtp'])->name('ads.verifyOtp');
    Route::post('/resendOtp', [CustomerController::class, 'resendOtp'])->name('ads.resendOtp');

    //Profile
    Route::get('/profile', [CustomerController::class, 'profile'])->name('ads.profile');
    Route::post('/updateProfile', [CustomerController::class, 'updateProfile'])->name('ads.updateProfile');
    Route::get('/phoneCheckUpdate/{id}', [CustomerController::class, 'phoneCheckUpdate'])->name('ads.phoneCheckUpdate');
    Route::get('/emailCheckUpdate/{id}', [CustomerController::class, 'emailCheckUpdate'])->name('ads.emailCheckUpdate');
    Route::post('/updatePassword', [CustomerController::class, 'updatePassword'])->name('ads.updatePassword');

    //Product
    Route::get('/post-requirement', [ManageProductController::class, 'postRequirement'])->name('ads.post-requirement');
    Route::post('/saveAdsProduct', [ManageProductController::class, 'saveAdsProduct'])->name('ads.saveAdsProduct');
    Route::get('/sellProductList', [ManageProductController::class, 'sellProductList'])->name('ads.sellProductList');
    Route::post('/getSellProductData', [ManageProductController::class, 'getSellProductData'])->name('ads.getSellProductData');
    Route::get('/buyProductList', [ManageProductController::class, 'buyProductList'])->name('ads.buyProductList');
    Route::post('/getBuyProductData', [ManageProductController::class, 'getBuyProductData'])->name('ads.getBuyProductData');
    Route::get('/productdelete/{id}', [ManageProductController::class, 'delete'])->name('ads.productdelete');
    Route::get('/productactivedeactive/{id}/{status}', [ManageProductController::class, 'status'])->name('ads.productactivedeactive');
    Route::get('/editAdsProduct/{id}', [ManageProductController::class, 'edit'])->name('ads.editAdsProduct');
    Route::post('/editAdsProduct/{id}', [ManageProductController::class, 'edit'])->name('ads.editAdsProduct');
    Route::get('/view/{id}', [ManageProductController::class, 'view'])->name('ads.view');
    
    Route::post('/wishlist', [WishlistController::class, 'wishlist'])->name('ads.wishlist');
    Route::get('/my_wishlist', [WishlistController::class, 'my_wishlist'])->name('ads.my_wishlist');
    
    Route::get('/quotesList', [ManageProductController::class, 'quotesList'])->name('ads.quotesList');
    Route::post('/quotesData', [ManageProductController::class, 'quotesData'])->name('ads.quotesData');
    
    Route::post('/get-customer-phone', [CustomerController::class, 'getPhone'])->name('ads:get-customer-phone');
    Route::post('/addComment', [CommentController::class, 'addComment'])->name('ads:addComment');

    Route::get('/logout', [CustomerAuth::class, 'logout'])->name('ads.logout');
});
