<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Blog;
use DataTables;
use Validator;
use Auth;

class CommentsController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Comment.index');
    }
    public function getCommentsData(){
        
        $data = Comment::with('blog:id,blog_title')->select('id', 'user_id', 'blog_id','name', 'email', 'comment','is_active','created_at')->orderBy('id', 'desc');

        return DataTables::of($data)
                        ->addColumn('user_type', function ($data) {
                            if(!empty($data->user_id) && isset($data->user_id)){
                              return "Admin";
                            }else{
                                return "User";
                            }
                            return $data->user_id;
                        })
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addColumn('blog_title', function ($data) {
                            return $data->blog->blog_title;
                        })
                        ->addColumn('active', function ($data) {
                            $checked = ($data->is_active == 1) ? 'checked' : '';
                            return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch" data-size="sm" ' . $checked . '  />';
                        })
                        ->addColumn('action', function($data) {
                            return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.comments.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.comments.commentDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                        })
                        ->rawColumns(['active', 'action','blog_title','user_type'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        $data = Blog::select('id', 'blog_title', 'is_active')->where('is_active',1)->orderBy('id','desc')->get();
                
        return view('Admin.Comment.add',['data'=>$data]);
    }

    public function save(Request $request) {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $comment = new Comment();
            
            $comment->user_id = $user->id;
            $comment->blog_id = $request->blog_id;
            $comment->name = $request->name;
            $comment->comment = $request->comment;
            $comment->is_active = 1;
            $comment->save();
            
            if ($comment) {
                return redirect()->route('admin.comments.index')->with('success', 'Comment is successfully save');
            } else {
                return redirect()->route('admin.comments.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.Comment.index');
        }
    }

    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = Comment::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->name = $request->name;
            $update->comment = $request->comment;
            $update->save();
            if ($update) {
                return redirect()->route('admin.comments.index')->with('success', 'Comment is successfully updated');
            } else {
                return redirect()->route('admin.comments.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin/Comment/edit',['update' => $update]);
    }

    public function status($id, $status) {

        $comment_status = Comment::where('id', $id)->update(array('is_active' => $status));
        if ($comment_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {
        $delete_comment = Comment::where('id', $id)->delete();

        if ($delete_comment) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
}
