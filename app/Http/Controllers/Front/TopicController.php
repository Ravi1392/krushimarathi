<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Traits\BlogSidebarTrait;

class TopicController extends Controller {

    use BlogSidebarTrait;

    public function __construct() {
        
    }

    public function topic_search(Request $request, $topic)
    {
        $query = str_replace('-', ' ', trim($topic));

        $blogs = Blog::with(['user:id,name,last_name'])
                    ->select('id','user_id','blog_title','blog_slug','blog_image','short_description','tags','is_active','created_at')
                    ->where('tags', 'LIKE', '%' . $query . '%')
                    ->orWhere('blog_title', 'LIKE', '%' . $query . '%')
                    ->orWhere('blog_slug', 'LIKE', '%' . $query . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $query . '%')
                    ->orWhere('meta_keyword', 'LIKE', '%' . $query . '%')
                    ->orWhere('first_title', 'LIKE', '%' . $query . '%')
                    ->orWhere('first_description', 'LIKE', '%' . $query . '%')
                    ->orWhere('second_title', 'LIKE', '%' . $query . '%')
                    ->orWhere('second_description', 'LIKE', '%' . $query . '%')
                    ->orWhere('third_title', 'LIKE', '%' . $query . '%')
                    ->orWhere('third_description', 'LIKE', '%' . $query . '%')
                    ->orWhere('fourth_title', 'LIKE', '%' . $query . '%')
                    ->orWhere('fourth_description', 'LIKE', '%' . $query . '%')
                    ->where('is_active', "=", 1)
                    ->orderBy('id', 'desc')
                    ->paginate(6);
        
        $sidebar_blogs = $this->getSearchSidebarBlogs();

        // Return the search results view with the blogs
        return view('frontend.pages.tag_results', compact('blogs', 'query', 'sidebar_blogs'));
        
    }

    public function loadTopicMore(Request $request,$page,$query)
    {

        if ($request->ajax()) {

            $query = str_replace('-', ' ', trim($query));
            $perPage = 6;
            
            // Fetch blogs with the given parameters
            $blogs = Blog::with(['user:id,name,last_name'])
                    ->select('id','user_id','blog_title','blog_slug','blog_image','short_description','tags','is_active', 'created_at')
                    ->where('tags', 'LIKE', '%' . $query . '%')
                    ->orWhere('blog_title', 'LIKE', '%' . $query . '%')
                    ->orWhere('blog_slug', 'LIKE', '%' . $query . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $query . '%')
                    ->orWhere('meta_keyword', 'LIKE', '%' . $query . '%')
                    ->orWhere('first_title', 'LIKE', '%' . $query . '%')
                    ->orWhere('first_description', 'LIKE', '%' . $query . '%')
                    ->orWhere('second_title', 'LIKE', '%' . $query . '%')
                    ->orWhere('second_description', 'LIKE', '%' . $query . '%')
                    ->orWhere('third_title', 'LIKE', '%' . $query . '%')
                    ->orWhere('third_description', 'LIKE', '%' . $query . '%')
                    ->orWhere('fourth_title', 'LIKE', '%' . $query . '%')
                    ->orWhere('fourth_description', 'LIKE', '%' . $query . '%')
                    ->where('is_active', "=", 1)
                    ->orderBy('id', 'desc')
                    ->skip(($page - 1) * $perPage)
                    ->take($perPage)
                    ->get();

            // Return blogs as a JSON response
            return response()->json($blogs);
        }

        // If not an AJAX request, return an error response
        return response()->json(['error' => 'Invalid Request'], 400);

    } 
}
