<?php

namespace App\Http\Controllers\Front\SpecialPages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\WeatherSpecial;
use App\Models\Blog;

class WeatherFrontController extends Controller {

    public function __construct() {
        
    }

    public function loadWeatherMore(Request $request,$page)
    {
        if ($request->ajax()) {
            $perPage = 8; // Number of items per page
            $skip = ($page - 1) * $perPage;
            
            $weatherData = WeatherSpecial::with('district')
                ->orderBy('created_at', 'desc')
                ->skip($skip)
                ->take($perPage)
                ->get();
    
            if ($weatherData->isEmpty()) {
                return response()->json(['error' => 'Invalid Request'], 400);
            }
    
            return response()->json($weatherData);
        }

        // If not an AJAX request, return an error response
        return response()->json(['error' => 'Invalid Request'], 400);
    }

    public function loadGalleryMore(Request $request,$page)
    {
        if ($request->ajax()) {
            $perPage = 9; // Number of items per page
            $skip = ($page - 1) * $perPage;

            // Fetch blogs with the given parameters
            $blogs = Blog::select('id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at')
                    ->where('is_active', "=", 1)
                    ->orderBy('id', 'desc')
                    ->skip($skip)
                    ->take($perPage)
                    ->get();
    
            if ($blogs->isEmpty()) {
                return response()->json(['error' => 'Invalid Request'], 400);
            }
    
            return response()->json($blogs);
        }

        // If not an AJAX request, return an error response
        return response()->json(['error' => 'Invalid Request'], 400);
    }

}