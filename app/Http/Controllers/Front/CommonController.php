<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Subscriber;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class CommonController extends Controller {

    public function __construct() {
        
    }
    
    public function adscode(){
        $adscode = DB::table('settings')->where('key', 'adscode')->value('value');
        return view('adscode',['adscode' => $adscode]);
    }
    
    public function rss_feed()
    {
        $blogs = Blog::with('category:id,name')->select('id', 'category_id', 'blog_title', 'blog_slug', 'meta_description', 'is_active', 'updated_at')
                ->orderBy('id', 'desc')
                ->get();
        
        return response()
            ->view('rss_feed', compact('blogs'))
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }

    public function search_blog(){
        
    }
    
    public function saveContactUs(Request $request){
        // Validate the form data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'comment' => 'required|string'
        ]);

        // Create a new comment
        $ContactUs = ContactUs::create([
            'subject' => $request->subject,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment
        ]);

        if($ContactUs){
            return back()->with(['success' => true, 'msg_value' => 'success', 'msg' => 'Message posted successfully!']);
        }else{
            return back()->with(['error' => true, 'msg_value' => 'error','msg' => 'Something went wrong.']);
        }
    }
    
    public function saveSubscription(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }
    
        $ip = $request->ip();
    
        Subscriber::create([
            'email' => $request->email,
            'ip_address' => $ip,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing!',
        ]);
    }
    
}
