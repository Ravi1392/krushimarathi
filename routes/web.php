<?php

use Illuminate\Support\Facades\Route;
 
//  Cron Controllers
use App\Http\Controllers\Cron\WeatherCronController;
use App\Http\Controllers\Cron\BajarbhavApiController;
use App\Http\Controllers\Cron\CommonCronController;

//  Admin Controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FooterCategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\VirtualStoriesController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\MobileUserController;
use App\Http\Controllers\Admin\Special\WeatherSpecialController;
use App\Http\Controllers\Admin\Special\SpecialCategoryController;
use App\Http\Controllers\Admin\Special\LiveUpdateController;
use App\Http\Controllers\Admin\Special\NewsFlashController;
use App\Http\Controllers\Admin\Special\BajarBhavAdminController;
use App\Http\Controllers\Admin\Special\CropRatesAdminController;

//IPL
use App\Http\Controllers\Admin\Ipl\TeamController;
use App\Http\Controllers\Admin\Ipl\MatchController;

//Admin Village Info
use App\Http\Controllers\Admin\VillageInfo\CountryController;
use App\Http\Controllers\Admin\VillageInfo\StateController;
use App\Http\Controllers\Admin\VillageInfo\DistrictController;
use App\Http\Controllers\Admin\VillageInfo\TalukaController;
use App\Http\Controllers\Admin\VillageInfo\VillageController;

// Front Controllers
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\FrontCategoryController;
use App\Http\Controllers\Front\CommonController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\BlogSearchController;
use App\Http\Controllers\Front\WebStoryController;
use App\Http\Controllers\Front\TopicController;
use App\Http\Controllers\Front\SiteMapController;
use App\Http\Controllers\Front\FeedController;
use App\Http\Controllers\Front\AuthorController;
use App\Http\Controllers\Front\SpecialPages\WeatherFrontController;

//Front Village Info
use App\Http\Controllers\Front\VillageInfo\VillageInfoController;
use App\Http\Controllers\Front\VillageInfo\VillageSiteMapController;
use App\Http\Controllers\Front\VillageInfo\VillageDataSiteMapController;
use App\Http\Controllers\Front\VillageInfo\FrontProfileController;

//Common
use App\Http\Controllers\Common\GeminiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

-------------------------Admin Routes-------------------------------------------*/

Auth::routes();

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize:clear');
    return '<h1>Cache cleared</h1>';
});

Route::group(['prefix' => 'cron'], function () {
    Route::get('/weather_update', [WeatherCronController::class, 'weather_update'])->name('cron.weather_update');
    Route::get('/fixDuplicateSlugs', [WeatherCronController::class, 'fixDuplicateSlugs'])->name('cron.fixDuplicateSlugs');
    Route::get('/fetchBatchBajarbhav', [BajarbhavApiController::class, 'fetchBatchBajarbhav'])->name('cron.fetchBatchBajarbhav');
    Route::get('/fetchCityBajarbhav', [BajarbhavApiController::class, 'fetchCityBajarbhav'])->name('cron.fetchCityBajarbhav');
    Route::get('/fetchBajarSamitiBajarbhav', [BajarbhavApiController::class, 'fetchBajarSamitiBajarbhav'])->name('cron.fetchBajarSamitiBajarbhav');
    Route::get('/cron_test', [WeatherCronController::class, 'cron_test'])->name('cron.cron_test');
    Route::get('/sendNewsletter', [WeatherCronController::class, 'sendNewsletter'])->name('cron.sendNewsletter');
    Route::get('/news_flash', [CommonCronController::class, 'news_flash'])->name('cron.news_flash');
    Route::get('/live_update', [CommonCronController::class, 'live_update'])->name('cron.live_update');
    
});

Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {

    //dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
    
    //Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/updateProfile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
    Route::post('/updatePassword', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');

    //Categories
    Route::get('/categoryList', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::post('/getCategoryData', [CategoryController::class, 'getCategoryData'])->name('admin.category.getData');
    Route::get('/addCategory', [CategoryController::class, 'add'])->name('admin.category.addcategory');
    Route::post('/saveCategory', [CategoryController::class, 'save'])->name('admin.category.save');
    Route::get('/editCategory/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/editCategory/{id}', [CategoryController::class, 'edit'])->name('admin.category.editsave'); 
    Route::get('/categorydelete/{id}', [CategoryController::class, 'delete'])->name('admin.category.categorydelete');
    Route::get('/categorycheck', [CategoryController::class, 'categoryCheck'])->name('admin.category.categorycheck');
    Route::get('/categoryslugcheck', [CategoryController::class, 'categorySlugCheck'])->name('admin.category.categoryslugcheck');
    Route::get('/categoryCheckUpdate/{id}', [CategoryController::class, 'categoryCheckUpdate'])->name('admin.category.categoryCheckUpdate');
    Route::get('/categorySlugCheckUpdate/{id}', [CategoryController::class, 'categorySlugCheckUpdate'])->name('admin.category.categorySlugCheckUpdate');
    Route::get('/categoryactivedeactive/{id}/{status}', [CategoryController::class, 'status'])->name('admin.category.categoryactivedeactive');
    Route::get('/categoryResetViews', [CategoryController::class, 'resetViews'])->name('admin.category.categoryResetViews');
    
    //Sub Categories
    Route::get('/subCategoryList', [SubCategoryController::class, 'index'])->name('admin.subcategory.index');
    Route::post('/getSubCategoryData', [SubCategoryController::class, 'getSubCategoryData'])->name('admin.subcategory.getData');
    Route::get('/addSubCategory', [SubCategoryController::class, 'add'])->name('admin.subcategory.addsubcategory');
    Route::post('/saveSubCategory', [SubCategoryController::class, 'save'])->name('admin.subcategory.save');
    Route::get('/editSubCategory/{id}', [SubCategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::post('/editSubCategory/{id}', [SubCategoryController::class, 'edit'])->name('admin.subcategory.editsave'); 
    Route::get('/subcategorydelete/{id}', [SubCategoryController::class, 'delete'])->name('admin.subcategory.subcategorydelete');
    Route::get('/subCategoryCheck', [SubCategoryController::class, 'subCategoryCheck'])->name('admin.subcategory.subcategorycheck');
    Route::get('/subCategorySlugCheck', [SubCategoryController::class, 'subCategorySlugCheck'])->name('admin.subcategory.subcategoryslugcheck');
    Route::get('/subCategoryCheckUpdate/{id}', [SubCategoryController::class, 'subCategoryCheckUpdate'])->name('admin.subcategory.subCategoryCheckUpdate');
    Route::get('/subCategorySlugCheckUpdate/{id}', [SubCategoryController::class, 'subCategorySlugCheckUpdate'])->name('admin.subcategory.subCategorySlugCheckUpdate');
    Route::get('/subCategoryActiveDeactive/{id}/{status}', [SubCategoryController::class, 'status'])->name('admin.subcategory.subCategoryActiveDeactive');
    Route::get('/subCategoryResetViews', [SubCategoryController::class, 'resetViews'])->name('admin.subcategory.subCategoryResetViews');

    //Footer Category
    Route::get('/footerCategoryList', [FooterCategoryController::class, 'index'])->name('admin.footercategory.index');
    Route::post('/getFooterCategoryData', [FooterCategoryController::class, 'getFooterCategoryData'])->name('admin.footercategory.getData');
    Route::get('/addFooterCategory', [FooterCategoryController::class, 'add'])->name('admin.footercategory.addfootercategory');
    Route::post('/saveFooterCategory', [FooterCategoryController::class, 'save'])->name('admin.footercategory.save');
    Route::get('/editFooterCategory/{id}', [FooterCategoryController::class, 'edit'])->name('admin.footercategory.edit');
    Route::post('/editFooterCategory/{id}', [FooterCategoryController::class, 'edit'])->name('admin.footercategory.editsave'); 
    Route::get('/footerCategorydelete/{id}', [FooterCategoryController::class, 'delete'])->name('admin.footercategory.footercategorydelete');
    Route::get('/footerCategorycheck', [FooterCategoryController::class, 'footerCategoryCheck'])->name('admin.footercategory.footercategorycheck');
    Route::get('/footerCategoryslugcheck', [FooterCategoryController::class, 'footerCategorySlugCheck'])->name('admin.footercategory.footercategoryslugcheck');
    Route::get('/footerCategoryCheckUpdate/{id}', [FooterCategoryController::class, 'footerCategoryCheckUpdate'])->name('admin.footercategory.footerCategoryCheckUpdate');
    Route::get('/footerCategorySlugCheckUpdate/{id}', [FooterCategoryController::class, 'footerCategorySlugCheckUpdate'])->name('admin.footercategory.footerCategorySlugCheckUpdate');
    Route::get('/footerCategoryactivedeactive/{id}/{status}', [FooterCategoryController::class, 'status'])->name('admin.footerCategory.footerCategoryactivedeactive');
    Route::get('/footerCategoryResetViews', [FooterCategoryController::class, 'resetViews'])->name('admin.footerCategory.footerCategoryResetViews');

    //Blogs
    Route::get('/blogList', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::post('/getBlogData', [BlogController::class, 'getBlogData'])->name('admin.blog.getData');
    Route::get('/addBlog', [BlogController::class, 'add'])->name('admin.blog.addBlog');
    Route::post('/saveBlog', [BlogController::class, 'save'])->name('admin.blog.save');
    Route::get('/editBlog/{id}', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::post('/editBlog/{id}', [BlogController::class, 'edit'])->name('admin.blog.editsave'); 
    Route::get('/getSubCategories/{category_id}', [BlogController::class, 'getSubcategories'])->name('admin.blog.getSubCategories');
    Route::get('/blogCheck', [BlogController::class, 'blogCheck'])->name('admin.blog.blogCheck');
    Route::get('/blogSlugcheck', [BlogController::class, 'blogSlugCheck'])->name('admin.blog.blogSlugCheck');
    Route::get('/blogView/{id}', [BlogController::class, 'blogView'])->name('admin.blog.view');
    Route::get('/blogDelete/{id}', [BlogController::class, 'delete'])->name('admin.blog.blogDelete');
    Route::get('/blogActiveDeactive/{id}/{status}', [BlogController::class, 'status'])->name('admin.blog.blogActiveDeactive');
    Route::get('/blogResetViews', [BlogController::class, 'resetViews'])->name('admin.blog.blogResetViews');

    //Setting
    Route::get('/setting', [SettingController::class, 'index'])->name('admin.setting.index');
    Route::post('/addSetting', [SettingController::class, 'add'])->name('admin.setting.addSetting');
    
    //Virtual Stories
    Route::get('/virtual_stories', [VirtualStoriesController::class, 'index'])->name('admin.virtualStories.index');
    Route::post('/getVirtualStoriesData', [VirtualStoriesController::class, 'getVirtualStoriesData'])->name('admin.virtualStories.getData');
    Route::get('/addVirtualStories', [VirtualStoriesController::class, 'add'])->name('admin.virtualStories.addVirtualStories');
    Route::post('/saveVirtualStories', [VirtualStoriesController::class, 'save'])->name('admin.virtualStories.save');
    Route::get('/storySlugcheck', [VirtualStoriesController::class, 'webStorySlugCheck'])->name('admin.virtualStories.storySlugcheck');
    Route::get('/storyDelete/{id}', [VirtualStoriesController::class, 'delete'])->name('admin.virtualStories.storyDelete');
    Route::get('/storyActiveDeactive/{id}/{status}', [VirtualStoriesController::class, 'status'])->name('admin.virtualStories.storyActiveDeactive');
    Route::get('/storyResetViews', [VirtualStoriesController::class, 'resetViews'])->name('admin.virtualStories.storyResetViews');
    
    //Comments
    Route::get('/comments', [CommentsController::class, 'index'])->name('admin.comments.index');
    Route::post('/getCommentsData', [CommentsController::class, 'getCommentsData'])->name('admin.comments.getData');
    Route::get('/addComment', [CommentsController::class, 'add'])->name('admin.comments.addComment');
    Route::post('/saveComment', [CommentsController::class, 'save'])->name('admin.comments.save');
    Route::get('/editComment/{id}', [CommentsController::class, 'edit'])->name('admin.comments.edit');
    Route::post('/editComment/{id}', [CommentsController::class, 'edit'])->name('admin.comments.editsave'); 
    Route::get('/commentDelete/{id}', [CommentsController::class, 'delete'])->name('admin.comments.commentDelete');
    Route::get('/commentActiveDeactive/{id}/{status}', [CommentsController::class, 'status'])->name('admin.comments.commentActiveDeactive');
    
    //Contact Us
    Route::get('/contactUs', [ContactUsController::class, 'index'])->name('admin.contactUs.index');
    Route::post('/getContactUsData', [ContactUsController::class, 'getContactUsData'])->name('admin.contactUs.getData');
    Route::get('/viewContactUs/{id}', [ContactUsController::class, 'view'])->name('admin.contactUs.view');
    
    //Special Category
    Route::get('/specialCategoryList', [SpecialCategoryController::class, 'index'])->name('admin.special_categories.index');
    Route::post('/getSpecialCategoryData', [SpecialCategoryController::class, 'getSpecialCategoryData'])->name('admin.special_categories.getData');
    Route::get('/addSpecialCategory', [SpecialCategoryController::class, 'add'])->name('admin.special_categories.addSpecialCategory');
    Route::post('/saveSpecialCategory', [SpecialCategoryController::class, 'save'])->name('admin.special_categories.save');
    Route::get('/editSpecialCategory/{id}', [SpecialCategoryController::class, 'edit'])->name('admin.special_categories.edit');
    Route::post('/editSpecialCategory/{id}', [SpecialCategoryController::class, 'edit'])->name('admin.special_categories.editsave');
    Route::get('/specialCategorycheck', [SpecialCategoryController::class, 'specialCategoryCheck'])->name('admin.special_categories.specialcategorycheck');
    Route::get('/specialCategoryslugcheck', [SpecialCategoryController::class, 'specialCategorySlugCheck'])->name('admin.special_categories.specialCategoryslugcheck');
    Route::get('/specialCategoryCheckUpdate/{id}', [SpecialCategoryController::class, 'specialCategoryCheckUpdate'])->name('admin.specialcategory.specialCategoryCheckUpdate');
    Route::get('/specialCategorySlugCheckUpdate/{id}', [SpecialCategoryController::class, 'specialCategorySlugCheckUpdate'])->name('admin.specialcategory.specialCategorySlugCheckUpdate');
    Route::get('/specialCategoryRestore/{id}', [SpecialCategoryController::class, 'restore'])->name('admin.special_categories.specialCategoryRestore');
    Route::get('/specialCategoryDelete/{id}', [SpecialCategoryController::class, 'delete'])->name('admin.special_categories.specialCategoryDelete');
    Route::get('/specialCategoryActiveSeactive/{id}/{status}', [SpecialCategoryController::class, 'status'])->name('admin.special_categories.specialCategoryActiveSeactive');
    Route::get('/specialCategoryResetViews', [SpecialCategoryController::class, 'resetViews'])->name('admin.special_categories.specialCategoryResetViews');
    
    //Special - Weather
    Route::get('/weather', [WeatherSpecialController::class, 'index'])->name('admin.weather.index');
    Route::post('/getWeatherData', [WeatherSpecialController::class, 'getWeatherData'])->name('admin.weather.getData');
    Route::get('/editWeather/{id}', [WeatherSpecialController::class, 'edit'])->name('admin.weather.edit');
    Route::post('/editWeather/{id}', [WeatherSpecialController::class, 'edit'])->name('admin.weather.editsave'); 
    Route::get('/weatherDelete/{id}', [WeatherSpecialController::class, 'delete'])->name('admin.weather.weatherDelete');
    Route::get('/weatherActiveDeactive/{id}/{status}', [WeatherSpecialController::class, 'status'])->name('admin.weather.weatherActiveDeactive');
    
    //Live Update
    Route::get('/liveUpdateList', [LiveUpdateController::class, 'index'])->name('admin.live_update.index');
    Route::post('/getLiveUpdateData', [LiveUpdateController::class, 'getLiveUpdateData'])->name('admin.live_update.getData');
    Route::get('/addLiveUpdate', [LiveUpdateController::class, 'add'])->name('admin.live_update.addLiveUpdate');
    Route::post('/saveLiveUpdate', [LiveUpdateController::class, 'save'])->name('admin.live_update.save');
    Route::get('/editLiveUpdate/{id}', [LiveUpdateController::class, 'edit'])->name('admin.live_update.edit');
    Route::post('/editLiveUpdate/{id}', [LiveUpdateController::class, 'edit'])->name('admin.live_update.editsave');
    Route::get('/liveUpdateSlugcheck', [LiveUpdateController::class, 'liveUpdateSlugCheck'])->name('admin.live_update.liveUpdateSlugCheck');
    Route::get('/liveUpdateSlugCheckUpdate/{id}', [LiveUpdateController::class, 'liveUpdateSlugCheckUpdate'])->name('admin.live_update.liveUpdateSlugCheckUpdate');
    Route::get('/liveUpdateDelete/{id}', [LiveUpdateController::class, 'delete'])->name('admin.live_update.liveUpdateDelete');
    Route::get('/liveUpdateRestore/{id}', [LiveUpdateController::class, 'restore'])->name('admin.live_update.liveUpdateRestore');
    Route::get('/liveUpdateActiveDeactive/{id}/{status}', [LiveUpdateController::class, 'status'])->name('admin.live_update.LiveUpdateActiveDeactive');
    Route::get('/liveUpdateView/{id}', [LiveUpdateController::class, 'view'])->name('admin.live_update.liveUpdateView');
    Route::get('/updatesResetViews', [LiveUpdateController::class, 'resetViews'])->name('admin.live_update.updatesResetViews');

    //Live Update Data
    Route::get('/liveUpdateData/{id}', [LiveUpdateController::class, 'liveData'])->name('admin.live_update.liveData');
    Route::post('/getLiveUpdateDataList/{id}', [LiveUpdateController::class, 'getLiveUpdateDataList'])->name('admin.live_update.getDataList');
    Route::get('/addLiveData/{id}', [LiveUpdateController::class, 'addData'])->name('admin.live_update.addLiveData');
    Route::post('/saveLiveData', [LiveUpdateController::class, 'saveData'])->name('admin.live_update.saveLiveData');
    Route::get('/editLiveData/{id}', [LiveUpdateController::class, 'editData'])->name('admin.live_update.editData');
    Route::post('/editLiveData/{id}', [LiveUpdateController::class, 'editData'])->name('admin.live_update.editSaveData');
    Route::get('/liveDataDelete/{id}', [LiveUpdateController::class, 'deleteData'])->name('admin.live_update.liveDataDelete');
    Route::get('/liveDataRestore/{id}', [LiveUpdateController::class, 'restoreData'])->name('admin.live_update.liveDataRestore');
    
    //News Flash
    Route::get('/newsFlashList', [NewsFlashController::class, 'index'])->name('admin.news_flash.index');
    Route::post('/getNewsFlashData', [NewsFlashController::class, 'getLiveUpdateData'])->name('admin.news_flash.getData');
    Route::get('/addNewsFlash', [NewsFlashController::class, 'add'])->name('admin.news_flash.addNewsFlash');
    Route::post('/saveNewsFlash', [NewsFlashController::class, 'save'])->name('admin.news_flash.save');
    Route::get('/editNewsFlash/{id}', [NewsFlashController::class, 'edit'])->name('admin.news_flash.edit');
    Route::post('/editNewsFlash/{id}', [NewsFlashController::class, 'edit'])->name('admin.news_flash.editsave');
    Route::get('/newsFlashSlugcheck', [NewsFlashController::class, 'newsFlashSlugCheck'])->name('admin.news_flash.newsFlashSlugCheck');
    Route::get('/newsFlashSlugCheckUpdate/{id}', [NewsFlashController::class, 'newsFlashSlugCheckUpdate'])->name('admin.news_flash.newsFlashSlugCheckUpdate');
    Route::get('/newsFlashDelete/{id}', [NewsFlashController::class, 'delete'])->name('admin.news_flash.newsFlashDelete');
    Route::get('/newsFlashRestore/{id}', [NewsFlashController::class, 'restore'])->name('admin.news_flash.newsFlashRestore');
    Route::get('/newsFlashActiveDeactive/{id}/{status}', [NewsFlashController::class, 'status'])->name('admin.news_flash.newsFlashActiveDeactive');
    Route::get('/newsFlashView/{id}', [NewsFlashController::class, 'view'])->name('admin.news_flash.newsFlashView');
    Route::get('/flashResetViews', [NewsFlashController::class, 'resetViews'])->name('admin.news_flash.flashResetViews');

    //News Flash Data
    Route::get('/newsFlashData/{id}', [NewsFlashController::class, 'flashData'])->name('admin.news_flash.flashData');
    Route::post('/getnewsFlashDataList/{id}', [NewsFlashController::class, 'getnewsFlashDataList'])->name('admin.news_flash.getDataList');
    Route::get('/addFlashData/{id}', [NewsFlashController::class, 'addData'])->name('admin.news_flash.addFlashData');
    Route::post('/saveData', [NewsFlashController::class, 'saveData'])->name('admin.news_flash.saveData');
    Route::get('/editFlashData/{id}', [NewsFlashController::class, 'editData'])->name('admin.news_flash.editData');
    Route::post('/editFlashData/{id}', [NewsFlashController::class, 'editData'])->name('admin.news_flash.editSaveData');
    Route::get('/flashDataDelete/{id}', [NewsFlashController::class, 'deleteData'])->name('admin.news_flash.flashDataDelete');
    Route::get('/flashDataRestore/{id}', [NewsFlashController::class, 'restoreData'])->name('admin.news_flash.flashDataRestore');
    
    //IPL
    Route::get('/teamList', [TeamController::class, 'index'])->name('admin.ipl.index');
    Route::post('/getTeamData', [TeamController::class, 'getTeamData'])->name('admin.ipl.getData');
    Route::post('/fetch-teams', [TeamController::class, 'storeTeams'])->name('admin.fetch.teams');
    Route::get('/editTeam/{id}', [TeamController::class, 'edit'])->name('admin.ipl.edit');
    Route::post('/editTeam/{id}', [TeamController::class, 'edit'])->name('admin.ipl.editsave');
    
    Route::get('/matchList', [MatchController::class, 'index'])->name('admin.match.index');
    Route::post('/getMatchData', [MatchController::class, 'getMatchData'])->name('admin.match.getData');
    Route::get('/editMatch/{id}', [MatchController::class, 'edit'])->name('admin.match.edit');
    Route::post('/ediMatch/{id}', [MatchController::class, 'edit'])->name('admin.match.editsave'); 
    Route::post('/storeMatchInfo/{match_id}/{system_id?}', [MatchController::class, 'storeMatchInfo'])->name('admin.match.storeMatchInfo');
    
    //Bajar Bhav Special
    Route::get('/CropNameList', [BajarBhavAdminController::class, 'index'])->name('admin.crop_name.index');
    Route::post('/getCropNameData', [BajarBhavAdminController::class, 'getCropNameData'])->name('admin.crop_name.getData');
    Route::get('/addCropName', [BajarBhavAdminController::class, 'add'])->name('admin.crop_name.addCropName');
    Route::post('/saveCropName', [BajarBhavAdminController::class, 'save'])->name('admin.crop_name.save');
    Route::get('/editCropName/{id}', [BajarBhavAdminController::class, 'edit'])->name('admin.crop_name.edit');
    Route::post('/editCropName/{id}', [BajarBhavAdminController::class, 'edit'])->name('admin.crop_name.editsave');
    Route::get('/cropNamedelete/{id}', [BajarBhavAdminController::class, 'delete'])->name('admin.crop_name.cropNameDelete');
    Route::get('/cropNameCheck', [BajarBhavAdminController::class, 'cropNameCheck'])->name('admin.crop_name.cropNameCheck');
    Route::get('/cropNameCheckUpdate/{id}', [BajarBhavAdminController::class, 'cropNameCheckUpdate'])->name('admin.crop_name.cropNameCheckUpdate');
    
    Route::get('/BajarBhavList', [BajarBhavAdminController::class, 'bajarbhav'])->name('admin.bajarbhav.index');
    Route::post('/getBajarBhavData', [BajarBhavAdminController::class, 'getBajarBhavData'])->name('admin.bajarbhav.getData');
    Route::get('/bajarbhavResetViews', [BajarBhavAdminController::class, 'resetViews'])->name('admin.bajarbhav.bajarbhavResetViews');
    
    Route::get('/CropRateList', [CropRatesAdminController::class, 'index'])->name('admin.crop_rate.index');
    Route::post('/getCropRateData', [CropRatesAdminController::class, 'getCropRateData'])->name('admin.crop_rate.getData');
    Route::get('/addCropRate', [CropRatesAdminController::class, 'add'])->name('admin.crop_rate.addCropRate');
    Route::post('/saveCropRate', [CropRatesAdminController::class, 'save'])->name('admin.crop_rate.save');
    Route::get('/getCropNames/{croptype_id}', [CropRatesAdminController::class, 'getCropName'])->name('admin.crop_rate.getCropNames');
    Route::get('/cropRatedelete/{id}', [CropRatesAdminController::class, 'delete'])->name('admin.crop_rate.cropRateDelete');
    Route::get('/editCropRate/{id}', [CropRatesAdminController::class, 'edit'])->name('admin.crop_rate.edit');
    Route::post('/editCropRate/{id}', [CropRatesAdminController::class, 'edit'])->name('admin.crop_rate.editsave');
    
    //Subscriber
    Route::get('/subscriberList', [SubscriberController::class, 'index'])->name('admin.subscriber.index');
    Route::post('/getsubscriberData', [SubscriberController::class, 'getSubscribersData'])->name('admin.subscriber.getData');
    Route::get('/addSubscriber', [SubscriberController::class, 'add'])->name('admin.subscriber.addSubscriber');
    Route::post('/saveSubscriber', [SubscriberController::class, 'save'])->name('admin.subscriber.save');
    Route::get('/editSubscriber/{id}', [SubscriberController::class, 'edit'])->name('admin.subscriber.edit');
    Route::post('/editSubscriber/{id}', [SubscriberController::class, 'edit'])->name('admin.subscriber.editsave');
    Route::get('/subscribercheck', [SubscriberController::class, 'subscriberCheck'])->name('admin.subscriber.subscribercheck');
    Route::get('/subscriberCheckUpdate/{id}', [SubscriberController::class, 'subscriberCheckUpdate'])->name('admin.subscriber.subscriberCheckUpdate');
    Route::get('/subscriberDelete/{id}', [SubscriberController::class, 'delete'])->name('admin.subscriber.subscriberDelete');
    
    //Mobile User
    Route::get('/mobileUserList', [MobileUserController::class, 'index'])->name('admin.mobile_user.index');
    Route::post('/getMobileUserData', [MobileUserController::class, 'getMobileUserData'])->name('admin.mobile_user.getData');
    Route::get('/addMobileUser', [MobileUserController::class, 'add'])->name('admin.mobile_user.addMobileUser');
    Route::post('/saveMobileUser', [MobileUserController::class, 'save'])->name('admin.mobile_user.save');
    Route::get('/editMobileUser/{id}', [MobileUserController::class, 'edit'])->name('admin.mobile_user.edit');
    Route::post('/editMobileUser/{id}', [MobileUserController::class, 'edit'])->name('admin.mobile_user.editsave');
    Route::get('/mobileUsercheck', [MobileUserController::class, 'mobileUserCheck'])->name('admin.mobile_user.mobileUsercheck');
    Route::get('/mobileUserCheckUpdate/{id}', [MobileUserController::class, 'mobileUserCheckUpdate'])->name('admin.mobile_user.mobileUserCheckUpdate');
    Route::get('/mobileUserDelete/{id}', [MobileUserController::class, 'delete'])->name('admin.mobile_user.mobileUserDelete');
    
    //Country Data
    Route::get('/countryList', [CountryController::class, 'index'])->name('admin.country.index');
    Route::post('/getCountryData', [CountryController::class, 'getCountryData'])->name('admin.country.getData');
    Route::get('/addCountry', [CountryController::class, 'add'])->name('admin.country.addCountry');
    Route::post('/saveCountry', [CountryController::class, 'save'])->name('admin.country.save');
    Route::get('/viewCountry/{id}', [CountryController::class, 'view'])->name('admin.country.view');
    Route::get('/editCountry/{id}', [CountryController::class, 'edit'])->name('admin.country.edit');
    Route::post('/editCountry/{id}', [CountryController::class, 'edit'])->name('admin.country.editsave');
    Route::get('/countrydelete/{id}', [CountryController::class, 'delete'])->name('admin.country.categorydelete');
    Route::get('/countryactivedeactive/{id}/{status}', [CountryController::class, 'status'])->name('admin.country.countryactivedeactive');
    Route::get('/countryRestore/{id}', [CountryController::class, 'restore'])->name('admin.country.countryRestore');
    Route::get('/countryResetViews', [CountryController::class, 'resetViews'])->name('admin.country.countryResetViews');

    //State Data
    Route::get('/stateList', [StateController::class, 'index'])->name('admin.state.index');
    Route::post('/getStateData', [StateController::class, 'getStateData'])->name('admin.state.getData');
    Route::get('/addState', [StateController::class, 'add'])->name('admin.state.addState');
    Route::post('/saveState', [StateController::class, 'save'])->name('admin.state.save');
    Route::get('/viewState/{id}', [StateController::class, 'view'])->name('admin.state.view');
    Route::get('/editState/{id}', [StateController::class, 'edit'])->name('admin.state.edit');
    Route::post('/editState/{id}', [StateController::class, 'edit'])->name('admin.state.editsave');
    Route::get('/statedelete/{id}', [StateController::class, 'delete'])->name('admin.state.statedelete');
    Route::get('/stateactivedeactive/{id}/{status}', [StateController::class, 'status'])->name('admin.state.stateactivedeactive');
    Route::get('/stateRestore/{id}', [StateController::class, 'restore'])->name('admin.state.stateRestore');
    Route::get('/stateslugcheck', [StateController::class, 'stateSlugCheck'])->name('admin.state.stateslugcheck');
    Route::get('/stateSlugCheckUpdate/{id}', [StateController::class, 'stateSlugCheckUpdate'])->name('admin.state.stateSlugCheckUpdate');
    Route::get('/stateResetViews', [StateController::class, 'resetViews'])->name('admin.state.stateResetViews');

    //District Data
    Route::get('/districtList', [DistrictController::class, 'index'])->name('admin.district.index');
    Route::post('/getDistrictData', [DistrictController::class, 'getDistrictData'])->name('admin.district.getData');
    Route::get('/addDistrict', [DistrictController::class, 'add'])->name('admin.district.addDistrict');
    Route::post('/saveDistrict', [DistrictController::class, 'save'])->name('admin.district.save');
    Route::get('/viewDistrict/{id}', [DistrictController::class, 'view'])->name('admin.district.view');
    Route::get('/editDistrict/{id}', [DistrictController::class, 'edit'])->name('admin.district.edit');
    Route::post('/editDistrict/{id}', [DistrictController::class, 'edit'])->name('admin.district.editsave');
    Route::get('/districtdelete/{id}', [DistrictController::class, 'delete'])->name('admin.district.districtdelete');
    Route::get('/districtactivedeactive/{id}/{status}', [DistrictController::class, 'status'])->name('admin.district.districtactivedeactive');
    Route::get('/districtRestore/{id}', [DistrictController::class, 'restore'])->name('admin.district.districtRestore');
    Route::get('/districtslugcheck', [DistrictController::class, 'districtSlugCheck'])->name('admin.district.districtslugcheck');
    Route::get('/districtSlugCheckUpdate/{id}', [DistrictController::class, 'districtSlugCheckUpdate'])->name('admin.district.districtSlugCheckUpdate');
    Route::get('/districtResetViews', [DistrictController::class, 'resetViews'])->name('admin.district.districtResetViews');

    //Taluka Data
    Route::get('/talukaList', [TalukaController::class, 'index'])->name('admin.taluka.index');
    Route::post('/getTalukaData', [TalukaController::class, 'getTalukaData'])->name('admin.taluka.getData');
    Route::get('/addTaluka', [TalukaController::class, 'add'])->name('admin.taluka.addTaluka');
    Route::post('/saveTaluka', [TalukaController::class, 'save'])->name('admin.taluka.save');
    Route::get('/viewTaluka/{id}', [TalukaController::class, 'view'])->name('admin.taluka.view');
    Route::get('/editTaluka/{id}', [TalukaController::class, 'edit'])->name('admin.taluka.edit');
    Route::post('/editTaluka/{id}', [TalukaController::class, 'edit'])->name('admin.taluka.editsave');
    Route::get('/talukaslugcheck', [TalukaController::class, 'talukaSlugCheck'])->name('admin.taluka.talukaslugcheck');
    Route::get('/talukaSlugCheckUpdate/{id}', [TalukaController::class, 'talukaSlugCheckUpdate'])->name('admin.taluka.talukaSlugCheckUpdate');
    Route::get('/talukadelete/{id}', [TalukaController::class, 'delete'])->name('admin.taluka.talukadelete');
    Route::get('/talukaactivedeactive/{id}/{status}', [TalukaController::class, 'status'])->name('admin.taluka.talukaactivedeactive');
    Route::get('/talukaRestore/{id}', [TalukaController::class, 'restore'])->name('admin.taluka.talukaRestore');
    Route::get('/talukaResetViews', [TalukaController::class, 'resetViews'])->name('admin.taluka.talukaResetViews');

    //Village Data
    Route::get('/villageList', [VillageController::class, 'index'])->name('admin.village.index');
    Route::post('/getVillageData', [VillageController::class, 'getVillageData'])->name('admin.village.getData');
    Route::get('/addVillage', [VillageController::class, 'add'])->name('admin.village.addVillage');
    Route::post('/saveVillage', [VillageController::class, 'save'])->name('admin.village.save');
    Route::get('/viewVillage/{id}', [VillageController::class, 'view'])->name('admin.village.view');
    Route::get('/editVillage/{id}', [VillageController::class, 'edit'])->name('admin.village.edit');
    Route::post('/editVillage/{id}', [VillageController::class, 'edit'])->name('admin.village.editsave');
    Route::get('/villageslugcheck', [VillageController::class, 'villageSlugCheck'])->name('admin.village.villageslugcheck');
    Route::get('/villageSlugCheckUpdate/{id}', [VillageController::class, 'villageSlugCheckUpdate'])->name('admin.village.villageSlugCheckUpdate');
    Route::get('/villagedelete/{id}', [VillageController::class, 'delete'])->name('admin.village.villagedelete');
    Route::get('/villageactivedeactive/{id}/{status}', [VillageController::class, 'status'])->name('admin.village.villageactivedeactive');
    Route::get('/villageRestore/{id}', [VillageController::class, 'restore'])->name('admin.village.villageRestore');
    Route::get('/villageResetViews', [VillageController::class, 'resetViews'])->name('admin.village.villageResetViews');
    
    //Logout
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
});

Route::group(['prefix' => 'ads'], function () {
    require __DIR__.'/advertise.php';
});

/*----------------------Front Routes-------------------------------------------*/

Route::group(['prefix' => 'in'], function () {
    Route::get('/', [VillageInfoController::class, 'index'])->name('in.countries');
    Route::get('/country/{country_slug}', [VillageInfoController::class, 'country'])->name('in.country');
    Route::get('/state/{state_slug}', [VillageInfoController::class, 'state'])->name('in.state');
    Route::get('/district/{district_slug}', [VillageInfoController::class, 'district'])->name('in.district');
    Route::get('/taluka/{taluka_slug}', [VillageInfoController::class, 'taluka'])->name('in.taluka');
    Route::get('/village/{village_slug}', [VillageInfoController::class, 'village'])->name('in.village');
    
    Route::get('/profile/{profile_slug}', [FrontProfileController::class, 'profile'])->name('in.profile');
});

Route::get('/', [FrontController::class, 'index']);

//AI Response
Route::post('/generate-answer', [GeminiController::class, 'generateAnswer'])->name('generate-answer');

//Sitemap Routes
Route::get('/category-sitemap.xml', [SiteMapController::class, 'category_sitemap']);
Route::get('/sub-category-sitemap1.xml', [SiteMapController::class, 'subCategory_sitemap1']);
Route::get('/page-sitemap.xml', [SiteMapController::class, 'page_sitemap']);
Route::get('/post-sitemap.xml', [SiteMapController::class, 'post_sitemap1']);
Route::get('/webstories-sitemap1.xml', [SiteMapController::class, 'webstories_sitemap1']);
Route::get('/post-images-sitemap1.xml', [SiteMapController::class, 'post_images_sitemap1']);
Route::get('/special-category-sitemap.xml', [SiteMapController::class, 'special_category_sitemap']);
Route::get('/author-sitemap.xml', [SiteMapController::class, 'author_sitemap']);
Route::get('/news-sitemap.xml', [SiteMapController::class, 'news_sitemap']);
Route::get('/live_update_sitemap.xml', [SiteMapController::class, 'live_update_sitemap1']);
Route::get('/news_flash_sitemap1.xml', [SiteMapController::class, 'news_flash_sitemap1']);

Route::get('/rss-feed', [CommonController::class, 'rss_feed']);

//Village info Sitemap Routes
Route::get('/country-sitemap.xml', [VillageSiteMapController::class, 'country_sitemap']);
Route::get('/state-sitemap.xml', [VillageSiteMapController::class, 'state_sitemap']);
Route::get('/district-sitemap.xml', [VillageSiteMapController::class, 'district_sitemap']);

Route::get('/taluka-sitemap{number}.xml', [VillageSiteMapController::class, 'taluka_sitemap'])
    ->where('number', '[0-9]+');

Route::get('/village-sitemap{number}.xml', [VillageDataSiteMapController::class, 'village_sitemap'])
    ->where('number', '[0-9]+');

Route::get('/profile-politicians-sitemap1.xml', [VillageSiteMapController::class, 'profile_politicians_sitemap1']);

//Rss feeds Routes
// Route::get('/feed.xml', [FeedController::class, 'post_feed1']); // All blogs
// Route::get('/{blog_slug}/feed', [FeedController::class, 'single_post_feed']); // Single blog
// Route::get('/category/{category_slug}/feed', [FeedController::class, 'single_category_all_post_feed']); // single category All related blogs
// Route::get('/sub_category/{sub_category_slug}/feed', [FeedController::class, 'single_sub_category_all_post_feed']); // Single Sub category All related blogs

Route::get('/ads.txt', [CommonController::class, 'adscode']);

Route::post('/saveContactUs', [CommonController::class, 'saveContactUs'])->name('front.saveContactUs');

Route::post('/saveSubscription', [CommonController::class, 'saveSubscription']);

// web stories
Route::get('/web-stories/{category_slug}', [WebStoryController::class, 'category_wise_web_stories'])->name('webstory.category_wise_stories');
Route::get('/web-story/{page}', [WebStoryController::class, 'loadWebStoryMore'])
        ->where('page', '^[0-9]+$')
        ->name('web-story.loadWebStoryMore');
Route::get('/web-story/{category_id}/{page}', [WebStoryController::class, 'loadCategoryWiseWebStoryMore'])
        ->where('page', '^[0-9]+$')
        ->name('web-story.loadCategoryWiseWebStoryMore');
Route::get('/web-story/{story_slug}', [WebStoryController::class, 'show'])->name('webstory.show');

//Author
Route::get('/author/{username}', [AuthorController::class, 'autherInfo'])->name('auther.info');
Route::get('/author/load-more/{user_id}/{page}', [AuthorController::class, 'loadAuthorBlogsMore'])->name('auther.loadMore');

//Topic
Route::get('/tag/{topic}', [TopicController::class, 'topic_search'])->name('tag.search');
Route::get('/topic/blogs/load-more/{page}/{query}', [TopicController::class, 'loadTopicMore'])->name('topic.blogs.loadMore');

//Search blogs
Route::get('/search/blogs', [BlogSearchController::class, 'search'])->name('search.blogs');
Route::get('/search/blogs/load-more/{page}/{query}', [BlogSearchController::class, 'loadSeachMore'])->name('search.blogs.loadMore');

//Weather
Route::get('/Weather/load-more/{page}', [WeatherFrontController::class, 'loadWeatherMore'])->name('weather.loadMore');

Route::get('/gallery/load-more/{page}', [WeatherFrontController::class, 'loadGalleryMore'])->name('gallery.loadMore');

Route::get('/{slug}', [FrontCategoryController::class, 'index'])
    ->where('slug', '[a-zA-Z0-9\-]{5,18}')
    ->name('front.show');

Route::get('/{blog_slug}', [FrontController::class, 'blog_view'])
    ->where('blog_slug', '[a-zA-Z0-9\-]{19,}')
    ->name('blog.view');
    
Route::get('/{blog_slug}/amp', [FrontController::class, 'amp_blog_view'])
    ->where('blog_slug', '[a-zA-Z0-9\-]{29,}')
    ->name('blog.amp');

Route::get('/{slug}/{sub_category}', [FrontCategoryController::class, 'category_wise_view'])->name('front.category_wise_view');
Route::get('/load-more/{category_slug}/{sub_category_slug}/{page}', [FrontCategoryController::class, 'loadMore']);

//Comment Section
Route::post('/blog/{blogId}/comment', [CommentController::class, 'store'])->name('comments.store');


