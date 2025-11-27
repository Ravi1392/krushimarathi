<?php

namespace App\Http\Controllers\Admin\Special;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Bajarbhav\CropType;
use App\Models\Bajarbhav\CropName;
use App\Models\Bajarbhav\CropRate;
use App\Models\Bajarbhav\BajarbhavSlug;
use DataTables;
use Validator;
use Auth;

class BajarBhavAdminController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Special.Bajarbhav.CropName.index');
    }

    public function getCropNameData(){
        
        $data = CropName::with('crop_type:id,mr_crop_type,en_crop_type')->orderBy('id', 'asc');

        return DataTables::of($data)
                        ->addColumn('crop_type_name', function ($data) {
                            return '<b>'. $data->crop_type->mr_crop_type . '</b> - '. $data->crop_type->en_crop_type;
                        })
                        ->addColumn('active', function ($data) {
                            $checked = ($data->is_active == 1) ? 'checked' : '';
                            return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch" data-size="sm" ' . $checked . '  />';
                        })
                        ->addColumn('action', function($data) {
                            return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.crop_name.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.crop_name.cropNameDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                        })
                        ->rawColumns(['active', 'action', 'crop_type_name'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        $data = CropType::where('is_active',1)->select('id', 'en_crop_type','mr_crop_type', 'is_active')->get();
                
        return view('Admin.Special.Bajarbhav.CropName.add',['data'=>$data]);
    }

    public function save(Request $request) {
        $user = Auth::user();
        if ($request->isMethod('post')) {

            $crop_name = new CropName();
            $crop_name->user_id = $user->id;
            $crop_name->crop_type_id = $request->crop_type_id;
            $crop_name->en_crop_name = $request->en_crop_name;
            $crop_name->mr_crop_name = $request->mr_crop_name;
            $crop_name->is_active = 1;
            $crop_name->save();
            
            if ($crop_name) {
                return redirect()->route('admin.crop_name.index')->with('success', 'Crop Name is successfully save');
            } else {
                return redirect()->route('admin.crop_name.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.Special.Bajarbhav.CropName.index');
        }

        //return view('Admin/ManageAdmin/add');
    }
    
    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $data = CropType::where('is_active',1)->select('id', 'en_crop_type','mr_crop_type', 'is_active')->get();
        $update = CropName::where('id', $id)->first();
        $user = Auth::user();

        if ($request->isMethod('post')) {
            
            $update->user_id = $user->id;
            $update->crop_type_id = $request->crop_type_id;
            $update->en_crop_name = $request->en_crop_name;
            $update->mr_crop_name = $request->mr_crop_name;
            $update->save();
            
            if ($update) {
                return redirect()->route('admin.crop_name.index')->with('success', 'Crop Name is successfully updated');
            } else {
                return redirect()->route('admin.crop_name.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.Special.Bajarbhav.CropName.edit',['data' => $data,'update' => $update]);
    }

    public function cropNameCheck() {
        // $user = Auth::user();

        $cropName = CropName::where(['mr_crop_name' => $_GET['mr_crop_name']])->count();
        if ($cropName != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function cropNameCheckUpdate($id) {
        
        $cropName = CropName::where(['mr_crop_name' => $_GET['mr_crop_name']])->where('id', '!=', $id)->count();
        if ($cropName != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function status($id, $status) {

        $crop_status = CropName::where('id', $id)->update(array('is_active' => $status));
        if ($crop_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {
        $delete_crop = CropName::where('id', $id)->delete();

        if ($delete_crop) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
    
     public function bajarbhav() {
        return view('Admin.Special.Bajarbhav.BajarBhavData.index');
    }

    public function getBajarBhavData(){
        
        $data = BajarbhavSlug::select('id','name','views')->orderBy('views', 'desc');

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->toJson();
    }
    
    public function resetViews() {

        $reset_views = BajarbhavSlug::query()->update([
            'views' => DB::raw('GREATEST(0, views - 5)')
        ]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    

}
