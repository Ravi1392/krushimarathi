<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Blog;
use App\Traits\BlogSidebarTrait;
use App\Traits\VisualStoriesTrait;
use App\Traits\CricketTrait;
use App\Models\Comment;
use App\Models\WeatherSpecial;
use App\Models\LiveUpdate;
use App\Models\NewsFlash;
use App\Models\Bajarbhav\BajarbhavSlug;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FrontController extends Controller {

    use BlogSidebarTrait, VisualStoriesTrait, CricketTrait;

    public function __construct() {
        
    }
    
    //home page code for show blogs data
    public function index() {

        $latest_blogs = Blog::active()->with(['category:id,category_slug',
                    'subcategory:id,subcategory_slug',
                    'blogimages:id,blog_id,cropped_image,width,created_at'
                ])
                ->select('id','category_id','sub_category_id','blog_title','blog_slug','blog_image','is_active')
                // ->whereNotIn('category_id', [33, 34])
                ->orderBy('id', 'desc')
                ->limit(2)
                ->get();
                
        $blogsByCategory = Category::active()->select('id','name','category_slug','is_active')->whereNotIn('id', [7])->orderByRaw("FIELD(id, 34, 30, 33) DESC")->get();

        $blogsByCategory = $blogsByCategory->map(function ($category) {
            $limitedBlogs = $category->blogs()->active()->select('id', 'sub_category_id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active')
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();

            $category->setRelation('blogs', $limitedBlogs);

            return $category;
        })->filter(function ($category) {
            return $category->blogs->isNotEmpty();
        })->values();
        
        $blogs_for_row = Blog::active()->select('id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at', 'views')
                // ->whereNotIn('category_id', [30, 31, 33])
                ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-60 days')))
                ->where(function ($query) {
                    $query->where('views', '>', 0); // Ensure only blogs with views > 0 are fetched
                })
                ->orderBy('views', 'desc')
                ->limit(3)
                ->get();
        
        $visual_stories = $this->getVisualStoriesForHome();
        $home_sidebar = $this->getHomeSidebarBlogs();
        
        $home_sidebar1 = $this->getHomeSidebarBlogs1();
        $home_sidebar2 = $this->getHomeSidebarBlogs2();
        $home_sidebar3 = $this->getHomeSidebarBlogs3();
        
        $weather_data = WeatherSpecial::active()->with('district:id,mr_name,en_name')
                        ->whereIn('id', [17, 26, 19, 22, 4, 15])
                        ->orderByRaw("FIELD(id, 17, 26, 19, 22, 4, 15)")
                        ->limit(6)
                        ->get();
        
        // $pointTable = $this->getPointTable();
        // $match = $this->getMatchCard();
        //'points_table' => $pointTable, 'match' => $match
        
        $live_update = LiveUpdate::with([
            'liveupdatedata:id,live_update_id,title'
        ])
        ->orderBy('id', 'desc')
        ->first();
        
        $mr_newsflash = $this->getNewsFlash(1);
        $hi_newsflash = $this->getNewsFlash(2);
        $en_newsflash = $this->getNewsFlash(3);
        
        $market_desk = $this->getMarketDesk();
                
        return view('frontend.pages.home',['latest_blogs' => $latest_blogs, 'category_blogs' => $blogsByCategory, 'home_sidebar' => $home_sidebar, 'visual_stories' => $visual_stories, 'blogs_for_row' => $blogs_for_row, 'weather_data' => $weather_data, 'home_sidebar1' => $home_sidebar1, 'home_sidebar2' => $home_sidebar2, 'home_sidebar3' => $home_sidebar3, 'live_update' => $live_update, 'mr_newsflash' => $mr_newsflash, 'hi_newsflash' => $hi_newsflash, 'en_newsflash' => $en_newsflash, 'market_desk' => $market_desk]);
    }

    
    //single blog view or details
    public function blog_view($blog_slug){
        
        // Get the previous blog and Get the next blog (with a larger ID)
        $common_logic = Blog::active()->select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active');
        
        if(!empty($blog_slug)){
            
            $common_query = BajarbhavSlug::select('id', 'name', 'crop_name', 'type', 'slug', 'code', 'created_at');

            $bajarbhav = (clone $common_query)->where('slug', "=" ,$blog_slug)->first();

            if(isset($bajarbhav) && !empty($bajarbhav)){

                $bajarbhav->increment('views');

                $displayName = $bajarbhav->name;
                $en_name = ucfirst(str_replace("-", " ", $bajarbhav->crop_name));
                $commodityCode = $bajarbhav->code;

                $crops = (clone $common_query)->where('type','=','crop')->get();
                $cities = (clone $common_query)->where('type','=','city')->get();
                $samitis = (clone $common_query)->where('type','=','samiti')->get();

                $bhajarbhav_news = Blog::select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at')
                    ->where('is_active', '=', 1)
                    ->whereIN('category_id', [6,22,23])
                    ->orderBy('id', 'desc')
                    ->limit(6)
                    ->get();

                if($bajarbhav->type == "crop"){

                    $pageTitle =  'आजचा ' .$displayName. ' बाजारभाव';
                    $dataNotFound = $displayName. ' या पिकासाठी सध्या कोणतीही बाजारभाव माहिती उपलब्ध नाही. कृपया नंतर पुन्हा तपासा.';
        
                    $cacheKey = "bajarbhav_C{$commodityCode}";
                    $filename = public_path("/assets/bajarbhav/crop/data_C{$commodityCode}.json");

                    // Try to get data from cache or JSON file
                    $bajarbhavData = Cache::remember($cacheKey, 3600, function () use ($filename) {
                        if (file_exists($filename)) {
                            $data = json_decode(file_get_contents($filename), true);
                            return is_array($data) ? $data : [];
                        }
                        Log::warning("No data found for {$filename}");
                        return [];
                    });

                    // crop image
                    $crop_image = asset("/public/assets/bajarbhav/crop/images/{$commodityCode}.webp");

                    return view('frontend.special_pages.bajarbhav.crop_bajarbhav_view', [
                        'cropName' => $displayName,
                        'bajarbhavData' => $bajarbhavData,
                        'pageTitle' => $pageTitle,
                        'dataNotFound' => $dataNotFound,
                        'bhajarbhav_news' => $bhajarbhav_news,
                        'crop_image' => $crop_image,
                        'crops' => $crops,
                        'cities' => $cities,
                        'samitis' => $samitis,
                        'en_name' => $en_name
                    ]);

                }elseif ($bajarbhav->type == "city") {

                    $pageTitle =  $displayName. ' जिल्हा आजचे बाजारभाव (Live Rates)';
                    $dataNotFound = $displayName. ' जिल्ह्यासाठी सध्या कोणतीही बाजारभाव माहिती उपलब्ध नाही. कृपया नंतर पुन्हा तपासा.';

                    $cacheKey = "bajarbhav_C{$commodityCode}";
                    $filename = public_path("/assets/bajarbhav/city/data_C{$commodityCode}.json");

                    // Try to get data from cache or JSON file
                    $bajarbhavData = Cache::remember($cacheKey, 3600, function () use ($filename) {
                        if (file_exists($filename)) {
                            $data = json_decode(file_get_contents($filename), true);
                            return is_array($data) ? $data : [];
                        }
                        Log::warning("No data found for {$filename}");
                        return [];
                    });

                    // city image
                    $city_image = asset("/public/assets/bajarbhav/city/images/{$commodityCode}.webp");

                    return view('frontend.special_pages.bajarbhav.city_bajarbhav_view', [
                        'cropName' => $displayName,
                        'bajarbhavData' => $bajarbhavData,
                        'pageTitle' => $pageTitle,
                        'dataNotFound' => $dataNotFound,
                        'bhajarbhav_news' => $bhajarbhav_news,
                        'crop_image' => $city_image,
                        'crops' => $crops,
                        'cities' => $cities,
                        'samitis' => $samitis,
                        'en_name' => $en_name
                    ]);

                }elseif ($bajarbhav->type == "samiti") {

                    $pageTitle =  $displayName. ' बाजार समितीचे आजचे शेतमाल बाजारभाव (Live Rates)';
                    $dataNotFound = $displayName. ' बाजार समितीसाठी सध्या कोणतीही बाजार भाव माहिती उपलब्ध नाही. कृपया नंतर पुन्हा तपासा.';

                    $cacheKey = "bajarbhav_C{$commodityCode}";
                    $filename = public_path("/assets/bajarbhav/bajarsamiti/data_C{$commodityCode}.json");

                    // Try to get data from cache or JSON file
                    $bajarbhavData = Cache::remember($cacheKey, 3600, function () use ($filename) {
                        if (file_exists($filename)) {
                            $data = json_decode(file_get_contents($filename), true);
                            return is_array($data) ? $data : [];
                        }
                        Log::warning("No data found for {$filename}");
                        return [];
                    });

                    // bajar Samiti image
                    $bajar_samiti_image = asset("/public/assets/bajarbhav/bajarsamiti/images/{$commodityCode}.webp");

                    return view('frontend.special_pages.bajarbhav.city_bajarbhav_view', [
                        'cropName' => $displayName,
                        'bajarbhavData' => $bajarbhavData,
                        'pageTitle' => $pageTitle,
                        'dataNotFound' => $dataNotFound,
                        'bhajarbhav_news' => $bhajarbhav_news,
                        'crop_image' => $bajar_samiti_image,
                        'crops' => $crops,
                        'cities' => $cities,
                        'samitis' => $samitis,
                        'en_name' => $en_name
                    ]);

                }

            }else{

                $blog = Blog::active()->with([
                    'user:id,name,last_name,username,profile',
                    'category:id,name,category_slug',
                    'subcategory:id,subcategory_slug,name',
                    'blogimages:id,blog_id,cropped_image,width,created_at',
                    'relatedBlogs:id,blog_title,blog_slug',
                    'relatedSecondBlogs:id,blog_title,blog_slug',
                    'comments' => function ($query) {
                        $query->select('id','blog_id','name','comment','created_at','is_active')
                        ->paginate(5);
                    }
                ])
                ->where('blog_slug', "=" ,$blog_slug)
                ->first();
    
                if(isset($blog) && !empty($blog)){
    
                    $sidebar_blogs = $this->getSidebarBlogs($blog->category->category_slug,$blog->id,null);
    
                    $blogs_for_row = (clone $common_logic)
                                ->where('category_id', '=', $blog->category_id)
                                ->where('sub_category_id', "!=" ,$blog->sub_category_id)
                                ->orderBy('id', 'desc')
                                ->limit(12)
                                ->get();
    
                    $blog->increment('views');
                    $totalComments = $blog->comments()->count();
    
                    return view('frontend.pages.blog_view',['category_slug' => $blog->category->category_slug, 'subcategory_slug' => $blog->subcategory->subcategory_slug, 'blog_slug' => $blog_slug, 'blog' => $blog, 'sidebar_blogs' => $sidebar_blogs, 'blogs_for_row' => $blogs_for_row, 'totalComments' => $totalComments]);
                }else{
    
                    $news_flash = NewsFlash::with([
                        'user:id,name,last_name,profile,username',
                        'newsflashsdata:id,news_flash_id,title,created_at',
                    ])->where('slug', "=" ,$blog_slug)
                    ->where('is_active', "=", 1)
                    ->first();
    
                    if(isset($news_flash) && !empty($news_flash)){
    
                        $news_flash->increment('views');
                        
                        if($news_flash->language_id == 1){
                            
                            $sidebar_blogs = $this->getSidebarBlogs('krushi',null,null);
                            
                            $blogs_for_row = (clone $common_logic)
                                ->whereIn('category_id', [6, 22, 23, 24, 25, 26, 27, 28, 29]);
                                
                        }elseif ($news_flash->language_id == 2) {
                            
                            $sidebar_blogs = $this->getSidebarBlogs('hindi',null,null);
                            
                            $blogs_for_row = (clone $common_logic)
                                ->whereIn('category_id', [30]);
                            
                        }elseif ($news_flash->language_id == 3) {
                            
                            $sidebar_blogs = $this->getSidebarBlogs('english',null,null);
                            
                            $blogs_for_row = (clone $common_logic)
                                ->whereIn('category_id', [33, 34]);
                            
                        }else {
                            
                            $sidebar_blogs = $this->getSidebarBlogs('knowledge-hub',null,null);
                            
                            $blogs_for_row = (clone $common_logic)
                                ->whereIn('category_id', [30, 34]);
                            
                        }
                        
                        $blogs_result = (clone $blogs_for_row)
                                        ->orderBy('id', 'desc')
                                        ->skip(4)
                                        ->limit(12)
                                        ->get();
    
                        return view('frontend.special_pages.news_flash',[ 'news_flash_slug' => $blog_slug, 'news_flash' => $news_flash, 'sidebar_blogs' => $sidebar_blogs, 'blogs_result' => $blogs_result]);
    
                    }else{
    
                        $live_update = LiveUpdate::with([
                            'user:id,name,last_name,profile,username',
                            'liveupdatesdata:id,live_update_id,title,description,created_at',
                        ])->where('slug', "=" ,$blog_slug)
                        ->where('is_active', "=", 1)
                        ->first();
    
                        if(isset($live_update) && !empty($live_update)){
                            $live_update->increment('views');
                        }
                        
                        $blogs_for_row = (clone $common_logic)
                                ->whereIn('category_id', [30,34])
                                ->orderBy('id', 'desc')
                                ->limit(12)
                                ->get();
    
                        return view('frontend.special_pages.live_news',[ 'live_update_slug' => $blog_slug, 'live_update' => $live_update, 'blogs_for_row' => $blogs_for_row]);
                    }
                }
            }
        }else{
            return response()->view('frontend.errors.404_error', [], 404);
        }
        
    }
    
    
    //AMP blog view details
    public function amp_blog_view($blog_slug){
        
        if(!empty($blog_slug)){

            $blog = Blog::active()->with([
                'user:id,name,last_name,username,profile',
                'category:id,name,category_slug',
                'subcategory:id,subcategory_slug,name',
                'blogimages:id,blog_id,cropped_image,width,created_at',
                'relatedBlogs:id,blog_title,blog_slug',
                'relatedSecondBlogs:id,blog_title,blog_slug'
            ])
            ->where('blog_slug', "=" ,$blog_slug)
            ->first();

            if(isset($blog) && !empty($blog)){

                $sidebar_blogs = $this->getSidebarBlogs($blog->category->category_slug,$blog->id,null);

                // Get the previous blog and Get the next blog (with a larger ID)
                $common_logic = Blog::active()->select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active')->where('category_id', '=', $blog->category_id);

                $blogs_for_row = (clone $common_logic)
                            ->orderBy('id', 'asc')
                            ->limit(4)
                            ->get();


                return view('frontend.pages.blog_amp_view',['category_slug' => $blog->category->category_slug, 'subcategory_slug' => $blog->subcategory->subcategory_slug, 'blog_slug' => $blog_slug, 'blog' => $blog, 'sidebar_blogs' => $sidebar_blogs, 'blogs_for_row' => $blogs_for_row]);
            }else{
                return response()->view('frontend.errors.404_error', [], 404);
            }

        }else{
            return response()->view('frontend.errors.404_error', [], 404);
        }
        
    }
    
    public function blog_view_old($category_slug, $subcategory_slug, $blog_slug){
        
        if(!empty($category_slug) && !empty($subcategory_slug) && !empty($blog_slug)){

            $blog = Blog::with([
                'user:id,name,last_name',
                'category:id,name,category_slug',
                'subcategory:id,subcategory_slug',
                'blogimages:id,blog_id,cropped_image,width,created_at'
            ])
            ->whereHas('category', function ($query) use ($category_slug) {
                $query->where('category_slug', $category_slug);
            })
            ->whereHas('subcategory', function ($query) use ($subcategory_slug) {
                $query->where('subcategory_slug', $subcategory_slug);
            })
            ->where('blog_slug', "=" ,$blog_slug)
            ->where('is_active', "=", 1)
            ->first();


            if(isset($blog) && !empty($blog)){
                
                $sidebar_blogs = $this->getSidebarBlogs($category_slug, $blog->id);
                
                // Get the previous blog and Get the next blog (with a larger ID)
                $common_logic = Blog::select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active')->where('is_active', '=', 1)->where('category_id', '=', $blog->category_id);

                $previousBlog = (clone $common_logic)
                                ->where('sub_category_id', '=', $blog->sub_category_id)
                                ->where('id', '<', $blog->id)
                                ->orderBy('id', 'desc')
                                ->first();
 
                $nextBlog = (clone $common_logic)
                            ->where('sub_category_id', '=', $blog->sub_category_id)
                            ->where('id', '>', $blog->id)
                            ->orderBy('id', 'asc')
                            ->first();

                $blogs_for_row = (clone $common_logic)
                            ->where('sub_category_id', "!=" ,$blog->sub_category_id)
                            ->orderBy('id', 'asc')
                            ->limit(6)
                            ->get();
                
                $blog->increment('views');
                
                return view('frontend.pages.blog_view',['category_slug' => $category_slug, 'subcategory_slug' => $subcategory_slug, 'blog_slug' => $blog_slug, 'blog' => $blog, 'sidebar_blogs' => $sidebar_blogs, 'previous_blog' => $previousBlog, 'next_blog' => $nextBlog, 'blogs_for_row' => $blogs_for_row]);
            }else{

            }

        }else{

        }
        
    }
    
}
