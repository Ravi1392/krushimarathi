<?php

namespace App\Http\Controllers\Admin\Special;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SpecialCategory;
use App\Models\User;
use Auth;
use DataTables;

class SpecialCategoryController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Special.SpecialCategory.index');
    }

    public function getSpecialCategoryData() {

        $data = SpecialCategory::select('id', 'name', 'views', 'is_active', 'deleted_at')->orderBy('id', 'desc')->withTrashed();

        return DataTables::of($data)
                        ->addColumn('active', function ($data) {
                            if($data->deleted_at != NULL){
                                return '';
                            }else{
                                $checked = ($data->is_active == 1) ? 'checked' : '';
                                return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch" data-size="sm" ' . $checked . '  />';
                            }
                        })
                        ->addColumn('action', function($data) {
                            
                            if($data->deleted_at != NULL){
                                return '<a class="restore_row font-size-16" data-value = "' . route('admin.special_categories.specialCategoryRestore', ['id' => $data->id]) . '" title = "Restore"><i class="icon-undo"></i></a>';
                            }else{
                                return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.special_categories.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>

                                <a class="delete_row font-size-16" data-value = "' . route('admin.special_categories.specialCategoryDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                            }
                        })
                        ->rawColumns(['active', 'action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        return view('Admin.Special.SpecialCategory.add');
    }

    public function save(Request $request) {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $category = new SpecialCategory();
            
            $category->user_id = $user->id;
            $category->name = $request->name;
            $category->category_slug = Str::slug($request->category_slug);
            $category->meta_keywords = $request->meta_keywords;
            $category->meta_description = $request->meta_description;
            $category->content_updated_at = now();
            $category->is_active = 1;
            $category->save();
            
            if ($category) {
                return redirect()->route('admin.special_categories.index')->with('success', 'Special category is successfully save');
            } else {
                return redirect()->route('admin.special_categories.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.Special.SpecialCategory.index');
        }

        //return view('Admin/ManageAdmin/add');
    }
    
    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = SpecialCategory::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->name = $request->name;
            $update->category_slug = Str::slug($request->category_slug);
            $update->meta_keywords = $request->meta_keywords;
            $update->meta_description = $request->meta_description;
            $update->content_updated_at = now();
            $update->save();
            if ($update) {
                return redirect()->route('admin.special_categories.index')->with('success', 'Special category is successfully updated');
            } else {
                return redirect()->route('admin.special_categories.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin/Special/SpecialCategory/edit',['update' => $update]);
    }

    public function specialCategoryCheck() {
        // $user = Auth::user();

        $specialCategory = SpecialCategory::where(['name' => $_GET['name']])->count();
        if ($specialCategory != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function specialCategorySlugCheck() {
        // $user = Auth::user();

        $specialCategorySlug = SpecialCategory::where(['category_slug' => Str::slug($_GET['category_slug'])])->count();
        if ($specialCategorySlug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function specialCategoryCheckUpdate($id) {
        
        $CheckUpdate = SpecialCategory::where(['name' => $_GET['name']])->where('id', '!=', $id)->count();
        if ($CheckUpdate != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function specialCategorySlugCheckUpdate($id) {
        
        $SlugCheckUpdate = SpecialCategory::where(['category_slug' => Str::slug($_GET['category_slug'])])->where('id', '!=', $id)->count();
        if ($SlugCheckUpdate != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function status($id, $status) {

        $category_status = SpecialCategory::where('id', $id)->update(array('is_active' => $status));
        if ($category_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {

        $delete_category = SpecialCategory::where('id', $id)->delete();

        if ($delete_category) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

    public function restore($id)
    {
        $record = SpecialCategory::onlyTrashed()->find($id);

        if ($record) {
            $record->restore(); // Restore the deleted record
            return response()->json(['message' => 'Record restored successfully!']);
        }

        return response()->json(['message' => 'Record not found!'], 404);
    }
    
    public function resetViews() {

        $reset_views = SpecialCategory::query()->update(['views' => 0]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
