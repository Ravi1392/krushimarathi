<?php

namespace App\Http\Controllers\Advertisement\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Advertisement\Comment;
use Mail;

class CommentController extends Controller
{

    public function addComment(Request $request)
    {

        $customer = auth('customer')->user();

        $comment = new Comment();

        if (Auth::guard('customer')->check()) {

            $customer_id = Auth::guard('customer')->id();

            $comment->customer_id = $customer_id;
            $comment->product_id = $request->product_id;
            $comment->comment = $request->comment;
            $comment->is_active = 1;

        }else{

            $comment->product_id = $request->product_id;
            $comment->name = $request->name;
            $comment->phone = $request->phone;
            $comment->email = $request->email;
            $comment->comment = $request->comment;
            $comment->is_active = 1;
            
        }
        
        if ($comment->save()) {
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'error']);
        }
    }

}
