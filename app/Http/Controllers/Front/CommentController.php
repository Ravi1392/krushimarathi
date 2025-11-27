<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Blog;

class CommentController extends Controller {

    public function __construct() {
        
    }

    public function store(Request $request, $blogId)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'comment' => 'required|string'
        ]);

        // Create a new comment
        $comment = Comment::create([
            'blog_id' => $blogId,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment
        ]);

        $blog = Blog::findOrFail($blogId);
        $blog->decrement('views');

        if($comment){
            return back()->with(['success' => true, 'msg_value' => 'success', 'msg' => 'Comment posted successfully!']);
        }else{
            return back()->with(['error' => true, 'msg_value' => 'error','msg' => 'Something went wrong.']);
        }
        
    }  
}
