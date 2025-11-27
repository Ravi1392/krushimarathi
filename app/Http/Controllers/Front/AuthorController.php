<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;

class AuthorController extends Controller {

    public function __construct() {
        
    }

    public function autherInfo(Request $request, $username)
    {
        $verify_auther = User::select('id','username','name','last_name','profile', 'profile_desc', 'is_active', 'updated_at')
                            ->where('is_active', '=', 1)
                            ->where('username', '=', $username)
                            ->first();
                            
        if(isset($verify_auther) && !empty($verify_auther)){

            $auther_blogs = Blog::select('id', 'user_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at')
                ->where('is_active', '=', 1)
                ->where('user_id','=', $verify_auther->id)
                ->orderBy('id', 'desc')
                ->limit(6)
                ->get();

            return view('frontend.pages.author_view',['auther_profile' => $verify_auther, 'auther_blogs' => $auther_blogs]);
        }else{
            return response()->view('frontend.errors.404_error', [], 404);
        }
    }
    
     public function loadAuthorBlogsMore(Request $request,$user_id,$page)
    {
        if ($request->ajax()) {
            $perPage = 6; // Number of items per page
            $skip = ($page - 1) * $perPage;
            
            $auther_blogs = Blog::select('id', 'user_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at')
                ->where('is_active', '=', 1)
                ->where('user_id','=', $user_id)
                ->orderBy('id', 'desc')
                ->skip($skip)
                ->take($perPage)
                ->get();
    
            if ($auther_blogs->isEmpty()) {
                // return response()->json(['error' => 'Invalid Request'], 400);
            }
    
            return response()->json($auther_blogs);
        }

        // If not an AJAX request, return an error response
        return response()->json(['error' => 'Invalid Request'], 400);
    }

}
