<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;
use Auth;
use DataTables;

class CategoryController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Category.index');
    }

    public function getCategoryData() {

        $data = Category::select('id', 'name', 'views', 'is_active')->orderBy('id', 'desc')->withTrashed();

        return DataTables::of($data)
                        ->addColumn('active', function ($data) {
                                $checked = ($data->is_active == 1) ? 'checked' : '';
                                return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch" data-size="sm" ' . $checked . '  />';
                           
                        })
                        ->addColumn('action', function($data) {
                                return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.category.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.category.categorydelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                           
                        })
                        ->rawColumns(['active', 'action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        return view('Admin/Category/add');
    }

    public function save(Request $request) {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $category = new Category();
            
            $category->user_id = $user->id;
            $category->name = $request->name;
            $category->category_slug = Str::slug($request->category_slug);
            $category->meta_keywords = $request->meta_keywords;
            $category->meta_description = $request->meta_description;
            $category->content_updated_at = now();
            $category->is_active = 1;
            $category->save();
            
            if ($category) {
                return redirect()->route('admin.category.index')->with('success', 'Category is successfully save');
            } else {
                return redirect()->route('admin.category.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.Category.index');
        }

        //return view('Admin/ManageAdmin/add');
    }
    
    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = Category::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->name = $request->name;
            $update->category_slug = Str::slug($request->category_slug);
            $update->meta_keywords = $request->meta_keywords;
            $update->meta_description = $request->meta_description;
            $update->content_updated_at = now();
            $update->save();
            if ($update) {
                return redirect()->route('admin.category.index')->with('success', 'Category is successfully updated');
            } else {
                return redirect()->route('admin.category.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin/Category/edit',['update' => $update]);
    }

    public function categoryCheck() {
        // $user = Auth::user();

        $category = Category::where(['name' => $_GET['name']])->count();
        
        if ($category != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function categorySlugCheck() {
        // $user = Auth::user();
        
        $category_slug = Str::slug($_GET['category_slug']);

        $slug = Category::where(['category_slug' => $category_slug])->count();
        
        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function categoryCheckUpdate($id) {
        
        $category = Category::where(['name' => $_GET['name']])->where('id', '!=', $id)->count();
        
        if ($category != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function categorySlugCheckUpdate($id) {
        
        $category_slug = Str::slug($_GET['category_slug']);
        
        $slug = Category::where(['category_slug' => $category_slug])->where('id', '!=', $id)->count();
        
        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function status($id, $status) {

        $category_status = Category::where('id', $id)->update(array('is_active' => $status));
        
        if ($category_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {
        
        $delete_category = Category::where('id', $id)->delete();

        if ($delete_category) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
    
    public function resetViews() {

        $reset_views = Category::query()->update(['views' => 0]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
