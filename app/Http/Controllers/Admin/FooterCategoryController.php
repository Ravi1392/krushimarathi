<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\FooterCategory;
use App\Models\User;
use Auth;
use DataTables;

class FooterCategoryController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.FooterCategory.index');
    }

    public function getFooterCategoryData() {

        $data = FooterCategory::select('id', 'name', 'views', 'is_active')->orderBy('id', 'desc');

        return DataTables::of($data)
                        ->addColumn('active', function ($data) {
                                $checked = ($data->is_active == 1) ? 'checked' : '';
                                return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch" data-size="sm" ' . $checked . '  />';
                            
                        })
                        ->addColumn('action', function($data) {
                                return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.footercategory.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.footercategory.footercategorydelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                            
                        })
                        ->rawColumns(['active', 'action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        return view('Admin.FooterCategory.add');
    }

    public function save(Request $request) {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $category = new FooterCategory();
            
            $category->user_id = $user->id;
            $category->name = $request->name;
            $category->category_slug = Str::slug($request->category_slug);
            $category->meta_keywords = $request->meta_keywords;
            $category->meta_description = $request->meta_description;
            $category->content_updated_at = now();
            $category->is_active = 1;
            $category->save();
            
            if ($category) {
                return redirect()->route('admin.footercategory.index')->with('success', 'Footer category is successfully save');
            } else {
                return redirect()->route('admin.footercategory.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.FooterCategory.index');
        }

        //return view('Admin/ManageAdmin/add');
    }
    
    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = FooterCategory::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->name = $request->name;
            $update->category_slug = Str::slug($request->category_slug);
            $update->meta_keywords = $request->meta_keywords;
            $update->meta_description = $request->meta_description;
            $update->content_updated_at = now();
            $update->save();
            if ($update) {
                return redirect()->route('admin.footercategory.index')->with('success', 'Footer Category is successfully updated');
            } else {
                return redirect()->route('admin.footercategory.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin/FooterCategory/edit',['update' => $update]);
    }

    public function footerCategoryCheck() {
        // $user = Auth::user();

        $service = FooterCategory::where(['name' => $_GET['name']])->count();
        if ($service != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function footerCategorySlugCheck() {
        // $user = Auth::user();

        $service = FooterCategory::where(['category_slug' => $_GET['category_slug']])->count();
        if ($service != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function footerCategoryCheckUpdate($id) {
        
        $service = FooterCategory::where(['name' => $_GET['name']])->where('id', '!=', $id)->count();
        if ($service != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function footerCategorySlugCheckUpdate($id) {
        
        $service = FooterCategory::where(['category_slug' => $_GET['category_slug']])->where('id', '!=', $id)->count();
        if ($service != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function status($id, $status) {

        $service_status = FooterCategory::where('id', $id)->update(array('is_active' => $status));
        if ($service_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {
        $delete_service = FooterCategory::where('id', $id)->delete();

        if ($delete_service) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
    
    public function resetViews() {

        $reset_views = FooterCategory::query()->update(['views' => 0]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
