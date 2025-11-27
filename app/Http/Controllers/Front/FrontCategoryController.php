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
use App\Models\BlogImage;
use App\Models\SpecialCategory;
use App\Models\MarathiSpecial;
use App\Models\WeatherSpecial;
use App\Models\DailyUpdate;
use App\Models\Ipl\Team;
use App\Models\Ipl\SportMatch;
use App\Models\Bajarbhav\CropRate;
use App\Models\Bajarbhav\BajarbhavSlug;
use App\Traits\BlogSidebarTrait;
use App\Traits\VisualStoriesTrait;
use Illuminate\Support\Facades\Log;

class FrontCategoryController extends Controller {

    use BlogSidebarTrait, VisualStoriesTrait;
    
    public function __construct() {
        
    }

    //category and footer pages
    public function index($slug) {

        if($slug == "aboutus" || $slug == "about-us"){
            $slug = "aboutus";
            $category_slug = $this->getFooterCategory($slug);
            //$sidebar_blogs = $this->getFooterSidebarBlogs();
            
            if ($category_slug) {
                $this->incrementFooterMenuCount($category_slug->id,$category_slug->views);
            }
            return view('frontend.footers.aboutus',['category' => $category_slug]);
        }
        elseif($slug == "terms-and-conditions" || $slug == "termsandconditions"){
            
            $slug = "termsandconditions";
            $category_slug = $this->getFooterCategory($slug);
            //$sidebar_blogs = $this->getFooterSidebarBlogs();
            
            if ($category_slug) {
                $this->incrementFooterMenuCount($category_slug->id,$category_slug->views);
            }
            return view('frontend.footers.termandcondition' ,['category' => $category_slug]);
        }
        elseif($slug == "contact-us"){

            $category_slug = $this->getFooterCategory($slug);
            //$sidebar_blogs = $this->getFooterSidebarBlogs();
            
            if ($category_slug) {
                $this->incrementFooterMenuCount($category_slug->id,$category_slug->views);;
            }
            return view('frontend.footers.contactus' ,['category' => $category_slug]);
        }
        elseif($slug == "privacy-policy"){

            $category_slug = $this->getFooterCategory($slug);
            //$sidebar_blogs = $this->getFooterSidebarBlogs();
            
            if ($category_slug) {
                $this->incrementFooterMenuCount($category_slug->id,$category_slug->views);
            }
            return view('frontend.footers.privacypolicy' ,['category' => $category_slug]);
        }
        elseif($slug == "disclaimer"){

            $category_slug = $this->getFooterCategory($slug);
            //$sidebar_blogs = $this->getFooterSidebarBlogs();
            
            if ($category_slug) {
                $this->incrementFooterMenuCount($category_slug->id,$category_slug->views);
            }
            return view('frontend.footers.disclaimer' ,['category' => $category_slug]);
        }
        elseif($slug == "affiliate"){
            
            $category_slug = $this->getFooterCategory($slug);
            //$sidebar_blogs = $this->getFooterSidebarBlogs();
            
            if ($category_slug) {
                $this->incrementFooterMenuCount($category_slug->id,$category_slug->views);
            }
            return view('frontend.footers.affiliate_disclosure' ,['category' => $category_slug]);
        }
        elseif($slug == "write-for-us"){
            
            $category_slug = $this->getFooterCategory($slug);
            
            if ($category_slug) {
                $this->incrementFooterMenuCount($category_slug->id,$category_slug->views);
            }
            return view('frontend.footers.write_for_us' ,['category' => $category_slug]);
        }
        elseif($slug == "advertisement"){
            
            $category_slug = $this->getFooterCategory($slug);
            
            if ($category_slug) {
                $this->incrementFooterMenuCount($category_slug->id,$category_slug->views);
            }
            return view('frontend.footers.advertisement' ,['category' => $category_slug]);
        }
        elseif($slug == "web-stories"){

            $category_info = Category::active()->select('id', 'name', 'category_slug', 'meta_description', 'meta_keywords', 'views', 'created_at', 'updated_at', 'content_updated_at')
                                    ->where('category_slug','=', $slug)
                                    ->first();
            if ($category_info) {
                $category_info->increment('views');
            }
            $visual_stories = $this->getVisualStories();

            $categories = Category::select('id', 'name', 'category_slug', 'created_at')->where('category_slug','!=', 'web-stories')->where('is_active', "=", 1)->whereHas('webStories')->get();

            return view('frontend.pages.visual_stories' ,['category' => $category_info, 'categories' => $categories, 'visual_stories' => $visual_stories]);
        }
        elseif($slug == "weather-special"){

            $spec_category_info = SpecialCategory::active()->select('id', 'name', 'category_slug', 'meta_description', 'meta_keywords', 'views', 'created_at', 'updated_at', 'content_updated_at', 'views')->where('category_slug','=', $slug)->first();
            
            if(empty($spec_category_info) && !isset($spec_category_info)){
                return response()->view('frontend.errors.404_error', [], 404);
            }
            
            if ($spec_category_info) {
               $spec_category_info->increment('views');
            }

            $Weather_data = WeatherSpecial::active()->with('district:id,mr_name,en_name')->limit(8)->get();
            
            $sidebar = $this->getSearchSidebarBlogs();
            
            $weather_news = Blog::select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at')
                ->where('is_active', '=', 1)
                ->where('category_id','=', 6)
                ->where('sub_category_id','=', 70)
                ->orderBy('id', 'desc')
                ->limit(6)
                ->get();

            return view('frontend.special_pages.weather_special',['spec_category_info' => $spec_category_info, 'Weather_data' => $Weather_data, 'sidebar' => $sidebar, 'weather_news' => $weather_news]);
        }
        elseif($slug == "points-table"){

            $spec_category_info = SpecialCategory::select('id', 'name', 'category_slug', 'meta_description', 'meta_keywords', 'views', 'created_at', 'updated_at', 'content_updated_at')->where('category_slug','=', $slug)->first();
            
            if(empty($spec_category_info) && !isset($spec_category_info)){
                return response()->view('frontend.errors.404_error', [], 404);
            }
            if ($spec_category_info) {
               $spec_category_info->increment('views');
            }
            
            $ipl_news = Blog::active()->select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at')
                ->where('category_id','=', 30)
                ->where('sub_category_id','=', 50)
                ->orderBy('id', 'desc')
                ->get();

            // $points_table_2025 = Team::select('id', 'year', 'shortname', 'img', 'matches', 'wins', 'loss', 'nr', 'pts', 'nrr')
            //     ->where('year',2025)
            //     ->orderBy('pts', 'desc') // Highest points first
            //     ->orderByRaw("COALESCE(CAST(NULLIF(nrr, '0') AS DECIMAL(10,3)), -9999) DESC") // Treat '0' or null as lowest
            //     ->orderBy('matches', 'desc') // More matches as tiebreaker
            //     ->get();
            
            $baseQuery = Team::select('id', 'year', 'shortname', 'img', 'matches', 'wins', 'loss', 'nr', 'pts', 'nrr')
                        ->orderBy('pts', 'desc')
                        ->orderByRaw("COALESCE(CAST(NULLIF(nrr, '0') AS DECIMAL(10,3)), -9999) DESC")
                        ->orderBy('matches', 'desc');
                        
            $points_table_2025 = (clone $baseQuery)->where('year', 2025)->get();
            $points_table_2024 = (clone $baseQuery)->where('year', 2024)->get();

            return view('frontend.special_pages.ipl.points_table',['spec_category_info' => $spec_category_info, 'ipl_news' => $ipl_news, 'points_table_2025' => $points_table_2025, 'points_table_2024' => $points_table_2024]);
        }
        elseif($slug == "schedule"){

            $spec_category_info = SpecialCategory::select('id', 'name', 'category_slug', 'meta_description', 'meta_keywords', 'views', 'created_at', 'updated_at', 'content_updated_at')->where('category_slug','=', $slug)->first();
            
            if(empty($spec_category_info) && !isset($spec_category_info)){
                return response()->view('frontend.errors.404_error', [], 404);
            }
            
            if ($spec_category_info) {
               $spec_category_info->increment('views');
            }
            
            $ipl_news = Blog::active()->select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at')
                ->where('category_id','=', 30)
                ->where('sub_category_id','=', 50)
                ->orderBy('id', 'desc')
                ->get();

            $matches = SportMatch::with(['firstteam:id,img','secondteam:id,img'])
                ->select('id', 'name', 'status', 'ipl_team_1_id', 'team1', 'ipl_team_2_id', 'team2', 'datetime_gmt', 'match_started', 'match_ended')
                ->where('datetime_gmt', '>', now()->toDateTimeString()) // Only future matches
                ->where('match_started', false) // Matches that haven't started
                ->orderBy('datetime_gmt', 'asc') // Order by date ascending
                ->get();
            
            $complete_matches = SportMatch::with([
                    'scores' => function ($query) {
                        $query->select('match_id', 'inning', 'runs', 'wickets', 'overs')
                            ->whereNull('deleted_at')
                            ->orderBy('id', 'desc');
                    },
                    'firstteam:id,img',
                    'secondteam:id,img'
                ])
                ->select('id', 'name', 'status', 'ipl_team_1_id', 'team1', 'ipl_team_2_id', 'team2', 'datetime_gmt', 'match_started', 'match_ended')
                ->where('match_started', true) // Matches that haven't started
                ->where('match_ended', true)
                ->orderBy('datetime_gmt', 'desc') // Order by date ascending
                ->get();

                $now = Carbon::now('UTC'); // Current time in UTC
                $today = Carbon::today('UTC'); // Start of today in UTC
        
            // Fetch the most relevant match for today (live)
            $live_match = SportMatch::with(['scores' => function ($query) {
                    $query->select('match_id', 'inning', 'runs', 'wickets', 'overs')->whereNull('deleted_at')->orderBy('id', 'desc');
                },'firstteam:id,img','secondteam:id,img'])
                ->select('id', 'name', 'status', 'ipl_team_1_id', 'team1', 'ipl_team_2_id', 'team2', 'datetime_gmt', 'match_started', 'match_ended')
                ->whereDate('datetime_gmt', $today)
                ->where(function ($query) use ($now) {
                    // Prioritize live match
                    $query->where(function ($q) {
                        $q->where('match_started', 1)
                            ->where('match_ended', 0);
                    });
                })
                ->orderBy('match_started', 'desc') // Live (1) before upcoming (0)
                ->orderBy('datetime_gmt', 'asc') // Earliest first
                ->first();

            return view('frontend.special_pages.ipl.match_schedule',['spec_category_info' => $spec_category_info, 'ipl_news' => $ipl_news, 'matches' => $matches, 'complete_matches' => $complete_matches, 'live_match' => $live_match]);
        }
        elseif($slug == "market-special"){

            $spec_category_info = SpecialCategory::select('id', 'name', 'category_slug', 'meta_description', 'meta_keywords', 'views', 'created_at', 'updated_at', 'content_updated_at')->where('category_slug','=', $slug)->first();
            
            if(empty($spec_category_info) && !isset($spec_category_info)){
                return response()->view('frontend.errors.404_error', [], 404);
            }
            
            if ($spec_category_info) {
               $spec_category_info->increment('views');
            }

            // $common_query = CropRate::with(['crop_name' => function($q){
            //     $q->select('id','en_crop_name','mr_crop_name');
            // }])->select('id','crop_type_id','crop_id','market_name','variety','unit','arrival','minimum_rate','maximum_rate','average_rate','created_at')->whereDate('created_at', today());

            // $vegetables = (clone $common_query)->where('crop_type_id','=',1)->get();
            // $fruits = (clone $common_query)->where('crop_type_id','=',2)->get();
            // $pulses = (clone $common_query)->where('crop_type_id','=',3)->get();
            // $flowers = (clone $common_query)->where('crop_type_id','=',4)->get();
            // $oilseeds = (clone $common_query)->where('crop_type_id','=',5)->get();
            // $grains = (clone $common_query)->where('crop_type_id','=',6)->get();
            // $fodder = (clone $common_query)->where('crop_type_id','=',7)->get();
            // $spices = (clone $common_query)->where('crop_type_id','=',8)->get();
            // $dry_fruits = (clone $common_query)->where('crop_type_id','=',9)->get();

            $common_query = BajarbhavSlug::select('id','name','crop_name','type','slug','created_at');


            $crops = (clone $common_query)->where('type','=','crop')->get();
            $cities = (clone $common_query)->where('type','=','city')->get();
            $samitis = (clone $common_query)->where('type','=','samiti')->get();

            $bhajarbhav_news = Blog::select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at')
                ->where('is_active', '=', 1)
                ->where('category_id','=', 6)
                ->where('sub_category_id','=', 44)
                ->orderBy('id', 'desc')
                ->limit(6)
                ->get();

            return view('frontend.special_pages.bajarbhav',['spec_category_info' => $spec_category_info, 'crops' => $crops, 'cities' => $cities, 'samitis' => $samitis, 'bhajarbhav_news' => $bhajarbhav_news]);
        }
        elseif($slug == "gallery"){

            $spec_category_info = SpecialCategory::select('id', 'name', 'category_slug', 'meta_description', 'meta_keywords', 'views', 'created_at', 'updated_at', 'content_updated_at')->where('category_slug','=', $slug)->first();
            
            if(empty($spec_category_info) && !isset($spec_category_info)){
                return response()->view('frontend.errors.404_error', [], 404);
            }
            
            if ($spec_category_info) {
               $spec_category_info->increment('views');
            }

            $images = Blog::select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at')
                ->where('is_active', '=', 1)
                ->orderBy('id', 'desc')
                ->limit(9)
                ->get();

            return view('frontend.special_pages.gallery',['spec_category_info' => $spec_category_info, 'images' => $images]);
        }
        elseif($slug == "krushi-tech-ai"){

            $spec_category_info = SpecialCategory::select('id', 'name', 'category_slug', 'meta_description', 'meta_keywords', 'views', 'created_at', 'updated_at', 'content_updated_at')->where('category_slug','=', $slug)->first();
            
            if(empty($spec_category_info) && !isset($spec_category_info)){
                return response()->view('frontend.errors.404_error', [], 404);
            }
            
            if ($spec_category_info) {
               $spec_category_info->increment('views');
            }
            
            $blogs_result = Blog::active()->select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active')
                            ->orderBy('id', 'desc')
                            ->limit(12)
                            ->get();

            return view('frontend.special_pages.krushi_ai',['spec_category_info' => $spec_category_info, 'blogs_result' => $blogs_result]);
        }
        else{
            
            $category_info = Category::active()->select('id', 'name', 'category_slug', 'meta_description', 'meta_keywords', 'views', 'created_at', 'updated_at', 'content_updated_at')
                        ->where('category_slug','=', $slug)
                        ->first();
            
            if(empty($category_info) && !isset($category_info)){
                return response()->view('frontend.errors.404_error', [], 404);
            }
            
            if ($category_info) {
               $category_info->increment('views');
            }

            $subcategories = SubCategory::active()->select('id','category_id','name','subcategory_slug','is_active')->where('category_id','=', $category_info->id)->get();
    
            $subcategories = $subcategories->map(function ($subcategory) {
                $limitedBlogs = $subcategory->blogs()->active()->select('id', 'sub_category_id', 'category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active')->orderBy('id', 'desc')->limit(9)->get();

                $subcategory->setRelation('blogs', $limitedBlogs);

                return $subcategory;
            })->filter(function ($category) {
                return $category->blogs->isNotEmpty();
            })->values();

            $blogs_for_row = Blog::active()->select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at', 'views')
                ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-15 days')))
                ->where('category_id','=', $category_info->id)
                ->where(function ($query) {
                    $query->where('views', '>', 0); // Ensure only blogs with views > 0 are fetched
                })
                ->orderBy('views', 'desc')
                ->limit(3)
                ->get();
            
            $visual_stories = $this->getVisualStoriesForCategories($category_info->id);
            
            if($slug == "english" || $slug == "knowledge-hub"){
                $title_name = "Popular News";
            }else if($slug == "hindi"){
                $title_name = "लोकप्रिय समाचार";
            }else{
                $title_name = "लोकप्रिय बातम्या";
            }

            return view('frontend.pages.blogs_list',['category' => $category_info, 'category_slug' => $slug,'sub_categories' => $subcategories, 'visual_stories' => $visual_stories, 'blogs_for_row' => $blogs_for_row, 'title_name' => $title_name]);
        }
 
    }
    
    //subcategory code
    public function category_wise_view($categorySlug, $sub_categories){
        
        Log::info("category_wise_view: {$categorySlug} -> {$sub_categories}");

        $category_info = Category::select('id', 'name', 'category_slug')->where('category_slug','=', $categorySlug)->first();
       
        $blogs = Blog::active()->with([
            'category:id,category_slug',
            'subcategory:id,subcategory_slug'
        ])
        ->select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active')
        ->whereHas('category', function ($query) use ($categorySlug) {
            $query->where('category_slug', $categorySlug);
        })
        ->whereHas('subcategory', function ($query) use ($sub_categories) {
            $query->where('subcategory_slug', $sub_categories);
        })
        ->orderBy('id', 'desc')
        ->paginate(6);

        $sub_category_info = SubCategory::select('id', 'name', 'subcategory_slug','meta_keywords', 'meta_description', 'created_at', 'content_updated_at')->where('subcategory_slug','=', $sub_categories)->first();
        Log::info("Start");
        Log::info("category_id: {$category_info->id}");
        Log::info("sub_category_id: {$sub_category_info->id}");
        $blogs_for_row = Blog::active()->select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at', 'views')
                ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-90 days')))
                ->where('category_id','=', $category_info->id)
                ->where('sub_category_id','=', $sub_category_info->id)
                ->orderBy('views', 'desc')
                ->limit(3)
                ->get();
        Log::info("End");
        $sidebar_blogs = $this->getSidebarBlogs($categorySlug, null, $sub_category_info->id);
        
        SubCategory::where('subcategory_slug','=', $sub_categories)->increment('views');
        
        return view('frontend.pages.category_wise_blog',['category_slug' => $categorySlug, 'subcategory_slug' => $sub_categories, 'blogs' => $blogs, 'sidebar_blogs' => $sidebar_blogs, 'category_info' => $category_info, 'sub_category_name' => $sub_category_info->name, 'blogs_for_row' => $blogs_for_row, 'sub_category_info' => $sub_category_info]);

    }

    public function loadMore(Request $request, $category_slug, $sub_category_slug, $page)
    {
        
        if ($request->ajax()) {
            
            $perPage = 6;
            // Fetch blogs with the given parameters
            $blogs = Blog::active()->with([
                'user:id,name,last_name',
                'category:id,category_slug',
                'subcategory:id,subcategory_slug'
            ])
            ->select('id', 'user_id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'short_description', 'is_active', 'created_at')
            ->whereHas('category', function ($query) use ($category_slug) {
                $query->where('category_slug', $category_slug);
            })
            ->whereHas('subcategory', function ($query) use ($sub_category_slug) {
                $query->where('subcategory_slug', $sub_category_slug);
            })
            ->orderBy('id', 'desc')
            ->skip(($page - 1) * $perPage) // Skip previously loaded records
            ->take($perPage) // Load next set of records
            ->get();

            // Return blogs as a JSON response
            return response()->json($blogs);
        }

        // If not an AJAX request, return an error response
        return response()->json(['error' => 'Invalid Request'], 400);
    }
    
}
