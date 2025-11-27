<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\FooterCategory;
use App\Models\SpecialCategory;
use App\Models\Blog;
use App\Models\Country;
use App\Models\State;
use App\Models\District;
use App\Models\Taluka;
use App\Models\Village;
use Auth;
use App\Models\Webstories;
use App\Models\VillageInfo\ProfilePoliticians;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if($user->role_id === 2){

            $categories_data = Category::active()->select('id','user_id','name','is_active','views')
                ->withCount('subCategories')
                ->withCount('blogs')
                ->where('user_id', "=", $user->id)
                ->get();
            
            $subCategories_data = SubCategory::active()->select('id', 'user_id', 'category_id', 'name', 'is_active', 'views')
                ->withCount('blogs')
                ->with('category:id,name')
                ->where('user_id', "=", $user->id)
                ->orderBy('category_id')
                ->get();

            $category_count = Category::active()->selectRaw('COUNT(*) as total_categories, SUM(views) as total_category_views')
            ->where('user_id', "=", $user->id)->first();

            $subCategory_count = SubCategory::active()->selectRaw('COUNT(*) as total_subcategories, SUM(views) as total_subcategory_views')->where('user_id', "=", $user->id)->first();

            $blogStatistics = Blog::active()->selectRaw('COUNT(*) as total_blogs, SUM(views) as total_blog_views')
            ->where('user_id', "=", $user->id)->first();

            $webStoriesStatistics = Webstories::active()->selectRaw('COUNT(*) as total_stories, SUM(views) as total_story_views')
            ->where('user_id', "=", $user->id)->first();

            $footerCategory_count = FooterCategory::active()->selectRaw('COUNT(*) as total_footercategories, SUM(views) as total_footercategory_views')->where('user_id', "=", $user->id)->first();

            $specialCategory_count = SpecialCategory::active()->selectRaw('COUNT(*) as total_specialcategories, SUM(views) as total_specialcategory_views')->where('user_id', "=", $user->id)->first();

            $mostViewedBlogs = Blog::active()->with('category:id,name')->select('id', 'category_id', 'blog_title', 'views')
                    ->where('user_id', "=", $user->id)
                    ->orderBy('views', 'desc')
                    ->limit(10)
                    ->get();
            $lowViewedBlogs = Blog::active()->with('category:id,name')->select('id', 'category_id', 'blog_title', 'views')
                    ->where('user_id', "=", $user->id)
                    ->orderBy('views', 'asc')
                    ->limit(10)
                    ->get();

        }else{

            $categories_data = Category::active()->select('id','user_id','name','is_active','views')
                    ->withCount('subCategories')
                    ->withCount('blogs')
                    ->get();

            $subCategories_data = SubCategory::active()->select('id', 'category_id', 'name', 'is_active', 'views')
                ->withCount('blogs')
                ->with('category:id,name')
                ->orderBy('category_id')
                ->get();
            
            $category_count = Category::active()->selectRaw('COUNT(*) as total_categories, SUM(views) as total_category_views')->first();

            $subCategory_count = SubCategory::active()->selectRaw('COUNT(*) as total_subcategories, SUM(views) as total_subcategory_views')->first();

            $blogStatistics = Blog::active()->selectRaw('COUNT(*) as total_blogs, SUM(views) as total_blog_views')->first();

            $webStoriesStatistics = Webstories::active()->selectRaw('COUNT(*) as total_stories, SUM(views) as total_story_views')->first();

            $footerCategory_count = FooterCategory::active()->selectRaw('COUNT(*) as total_footercategories, SUM(views) as total_footercategory_views')->first();

            $specialCategory_count = SpecialCategory::active()->selectRaw('COUNT(*) as total_specialcategories, SUM(views) as total_specialcategory_views')->first();

            $mostViewedBlogs = Blog::active()->with('category:id,name')->select('id', 'category_id', 'blog_title', 'views')
                        ->orderBy('views', 'desc')
                        ->limit(10)
                        ->get();
            $lowViewedBlogs = Blog::active()->with('category:id,name')->select('id', 'category_id', 'blog_title', 'views')
                        ->orderBy('views', 'asc')
                        ->limit(10)
                        ->get();

        }

        $totalCountry = Country::active()->selectRaw('COUNT(*) as total_countries, SUM(views) as total_country_views')->first();
        $totalState = State::active()->selectRaw('COUNT(*) as total_states, SUM(views) as total_state_views')->first();
        $totalDistrict = District::active()->selectRaw('COUNT(*) as total_districts, SUM(views) as total_district_views')->first();
        $totalTaluka = Taluka::active()->selectRaw('COUNT(*) as total_talukas, SUM(views) as total_taluka_views')->first();
        $totalVillage = Village::active()->selectRaw('COUNT(*) as total_villages, SUM(views) as total_village_views')->first();
        
        $profilepoliticians = ProfilePoliticians::selectRaw('COUNT(*) as total_profiles, SUM(views) as total_profile_views')->first();

        // Prepare data for pie chart
        $pieChartData = [
            [
                'name' => 'Blog',
                'value' => $blogStatistics->total_blogs,
                'views' => $blogStatistics->total_blog_views
            ],
            [
                'name' => 'Categories',
                'value' => $category_count->total_categories,
                'views' => $category_count->total_category_views
            ],
            [
                'name' => 'Sub Categories',
                'value' => $subCategory_count->total_subcategories,
                'views' => $subCategory_count->total_subcategory_views
            ],
            
            [
                'name' => 'Special Categories',
                'value' => $specialCategory_count->total_specialcategories,
                'views' => $specialCategory_count->total_specialcategory_views
            ],
            [
                'name' => 'Footer Categories',
                'value' => $footerCategory_count->total_footercategories,
                'views' => $footerCategory_count->total_footercategory_views
            ],
            [
                'name' => 'Web Stories',
                'value' => $webStoriesStatistics->total_stories,
                'views' => $webStoriesStatistics->total_story_views
            ]
        ];

        return view('Admin.home', ['category_count' => $category_count, 'subCategory_count' => $subCategory_count, 'blogStatistics' => $blogStatistics, 'webStoriesStatistics' => $webStoriesStatistics, 'footerCategory_count' => $footerCategory_count, 'specialCategory_count' => $specialCategory_count, 'categories_data' => $categories_data, 'subCategories_data' => $subCategories_data, 'mostViewedBlogs' => $mostViewedBlogs, 'lowViewedBlogs' => $lowViewedBlogs, 'pieChartData' => $pieChartData, 'totalCountry' => $totalCountry, 'totalState' => $totalState, 'totalDistrict' => $totalDistrict, 'totalTaluka' => $totalTaluka, 'totalVillage' => $totalVillage, 'profilepoliticians' => $profilepoliticians]);
    }
}
