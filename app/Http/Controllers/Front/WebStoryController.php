<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Webstories;
use App\Models\WebstoriesData;
use App\Models\Category;
use App\Traits\VisualStoriesTrait;


class WebStoryController extends Controller {

    use VisualStoriesTrait;

    public function __construct() {
        
    }

    public function show($slug){
        
       $webstories = Webstories::with(['webstories_data:id,visual_stories_id,value,story_title,story_description,file_data,image_credit,created_at'])
                                ->where('slug','=',$slug)
                                ->where('is_active','=',1)
                                ->first();

        if(isset($webstories) && !empty($webstories))
        {
            $webstories->increment('views');
            return view('webStories/web-story', compact('webstories'));
        }
        else
        {
            return response()->view('frontend.errors.404_error', [], 404);
        }
    }

    public function loadWebStoryMore(Request $request, $page)
    {
        
        if ($request->ajax()) {

            $perPage = 5;
            
            // Fetch blogs with the given parameters
            $webstories = Webstories::with('category:id,name')->where('is_active', 1)
            ->orderBy('id', 'desc')
            ->skip(($page - 1) * $perPage) // Skip previously loaded records
            ->take($perPage) // Load next set of records
            ->get();

            // Return blogs as a JSON response
            return response()->json($webstories);
        }

        // If not an AJAX request, return an error response
        return response()->json(['error' => 'Invalid Request'], 400);
    }

    public function category_wise_web_stories($category_slug){

        $category_info = Category::select('id', 'name', 'category_slug', 'meta_description', 'meta_keywords', 'views', 'created_at', 'updated_at', 'content_updated_at')
        ->where('category_slug','=', $category_slug)
        ->where('is_active', "=", 1)
        ->first();

        $visual_stories = $this->getCategoryWiseWebStories($category_info->id);

        $categories = Category::select('id', 'name', 'category_slug', 'created_at')->where('category_slug','!=', 'web-stories')->where('is_active', "=", 1)->whereHas('webStories')->get();

        return view('frontend.pages.category_wise_web_stories' ,['category' => $category_info, 'categories' => $categories, 'visual_stories' => $visual_stories]);
    }
    
    public function loadCategoryWiseWebStoryMore(Request $request, $category_id, $page)
    {
        
        if ($request->ajax()) {

            $perPage = 5;
            
            // Fetch blogs with the given parameters
            $categoryWiseWebStories = Webstories::where('is_active', 1)
            ->where('category_id','=',$category_id)
            ->orderBy('id', 'desc')
            ->skip(($page - 1) * $perPage) // Skip previously loaded records
            ->take($perPage) // Load next set of records
            ->get();

            // Return blogs as a JSON response
            return response()->json($categoryWiseWebStories);
        }

        // If not an AJAX request, return an error response
        return response()->json(['error' => 'Invalid Request'], 400);
    }
    
}
