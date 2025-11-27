<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Auth;
use DataTables;

class SubCategoryController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.SubCategory.index');
    }

    public function getSubCategoryData() {

        $data = SubCategory::with('category:id,name')
                            ->select('id', 'name', 'category_id', 'views', 'created_at', 'is_active')
                            ->orderBy('id', 'desc');

        return DataTables::of($data)
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addColumn('category_name', function ($data) {
                            return $data->category->name;
                        })
                        ->addColumn('active', function ($data) {
                            $checked = ($data->is_active == 1) ? 'checked' : '';
                            return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch" data-size="sm" ' . $checked . '  />';
                        })
                        ->addColumn('action', function($data) {
                            return '<a class="font-size-16" href="' . route('admin.subcategory.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.subcategory.subcategorydelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                        })
                        ->rawColumns(['active', 'action', 'category_name'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        $data = Category::where('is_active',1)->select('id', 'name', 'is_active')->get();
                
        return view('Admin.SubCategory.add',['data'=>$data]);
    }

    public function save(Request $request) {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $subcategory = new SubCategory();
            
            $subcategory->user_id = $user->id;
            $subcategory->category_id = $request->category_id;
            $subcategory->name = $request->name;
            $subcategory->subcategory_slug = Str::slug($request->subcategory_slug);
            $subcategory->meta_keywords = $request->meta_keywords;
            $subcategory->meta_description = $request->meta_description;
            $subcategory->content_updated_at = now();
            $subcategory->is_active = 1;
            $subcategory->save();
            
            if ($subcategory) {
                return redirect()->route('admin.subcategory.index')->with('success', 'Sub Category is successfully save');
            } else {
                return redirect()->route('admin.subcategory.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.SubCategory.index');
        }

        //return view('Admin/ManageAdmin/add');
    }
    
    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $data = Category::where('is_active',1)->select('id', 'name', 'is_active')->get();
        $update = SubCategory::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->category_id = $request->category_id;
            $update->name = $request->name;
            $update->subcategory_slug = Str::slug($request->subcategory_slug);
            $update->meta_keywords = $request->meta_keywords;
            $update->meta_description = $request->meta_description;
            $update->content_updated_at = now();
            $update->save();

            if ($update) {
                return redirect()->route('admin.subcategory.index')->with('success', 'Sub Category is successfully updated');
            } else {
                return redirect()->route('admin.subcategory.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.SubCategory.edit',['data' => $data,'update' => $update]);
    }

    public function subCategoryCheck(Request $request) {
       
        $subcategory = SubCategory::where('name', $_GET['name'])
                ->where('category_id', $_GET['category_id'])
                ->count();
        if ($subcategory != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function subCategorySlugCheck() {
        
        $subcategory_slug = Str::slug($_GET['subcategory_slug']);
        
        $subcategoryslug = SubCategory::where(['subcategory_slug' => $subcategory_slug])->count();
        if ($subcategoryslug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function subCategoryCheckUpdate($id) {

        $subcategory = SubCategory::where('name', $_GET['name'])
                ->where('category_id', $_GET['category_id'])
                ->where('id', '!=', $id)
                ->count();
        if ($subcategory != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function subCategorySlugCheckUpdate($id) {
        
        $subcategory_slug = Str::slug($_GET['subcategory_slug']);
        
        $subcategory = SubCategory::where(['subcategory_slug' => $subcategory_slug])->where('id', '!=', $id)->count();

        if ($subcategory != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function status($id, $status) {

        $subcategory_status = SubCategory::where('id', $id)->update(array('is_active' => $status));
        if ($subcategory_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {
        $delete_subcategory = SubCategory::where('id', $id)->delete();

        if ($delete_subcategory) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
    
    public function resetViews() {

        $reset_views = SubCategory::query()->update(['views' => 0]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
