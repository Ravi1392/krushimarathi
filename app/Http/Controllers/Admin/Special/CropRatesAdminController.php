<?php

namespace App\Http\Controllers\Admin\Special;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Bajarbhav\CropType;
use App\Models\Bajarbhav\CropName;
use App\Models\Bajarbhav\CropRate;
use DataTables;
use Validator;
use Auth;

class CropRatesAdminController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Special.Bajarbhav.CropRate.index');
    }

    public function getCropRateData(){
        
        $data = CropRate::orderBy('id', 'asc');

        return DataTables::of($data)
                        ->addColumn('action', function($data) {
                            return '<a class="font-size-16" href="' . route('admin.crop_rate.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                            <a class="delete_row font-size-16" data-value = "' . route('admin.crop_rate.cropRateDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        $data = CropType::select('id', 'mr_crop_type','en_crop_type', 'is_active')->where('is_active',1)->get();
                
        return view('Admin.Special.Bajarbhav.CropRate.add',['data'=>$data]);
    }

    public function save(Request $request) {
        $user = Auth::user();
        if ($request->isMethod('post')) {

            $crop_rate = new CropRate();
            $crop_rate->user_id = $user->id;
            $crop_rate->crop_type_id = $request->crop_type_id;
            $crop_rate->crop_id = $request->crop_id;
            $crop_rate->market_name = $request->market_name;
            $crop_rate->variety = $request->variety;
            $crop_rate->unit = $request->unit;
            $crop_rate->arrival = $request->arrival;
            $crop_rate->minimum_rate = $request->minimum_rate;
            $crop_rate->maximum_rate = $request->maximum_rate;
            $crop_rate->average_rate = $request->average_rate;
            $crop_rate->save();
            
            if ($crop_rate) {
                return redirect()->route('admin.crop_rate.index')->with('success', 'Crop Rate is successfully save');
            } else {
                return redirect()->route('admin.crop_rate.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.Special.Bajarbhav.CropRate.index');
        }
    }

    public function getCropName($croptype_id)
    {
        $cropNames = CropName::select('id', 'mr_crop_name', 'en_crop_name', 'is_active')->where('is_active',1)->where('crop_type_id', $croptype_id)->get();
        return response()->json($cropNames);
    }
    
    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = CropRate::where('id', $id)->first();
        $cropType = CropType::select('id', 'en_crop_type','mr_crop_type')->where('id', '=', $update->crop_type_id)->first();
        $cropName = CropName::select('id', 'crop_type_id', 'en_crop_name','mr_crop_name')->where('id', '=', $update->crop_id)->where('crop_type_id', '=', $update->crop_type_id)->first();
        
        if ($request->isMethod('post')) {

            $update->market_name = $request->market_name;
            $update->variety = $request->variety;
            $update->unit = $request->unit;
            $update->arrival = $request->arrival;
            $update->minimum_rate = $request->minimum_rate;
            $update->maximum_rate = $request->maximum_rate;
            $update->average_rate = $request->average_rate;
            $update->save();

            if ($update) {
                return redirect()->route('admin.crop_rate.index')->with('success', 'Crop Rate is successfully updated');
            } else {
                return redirect()->route('admin.crop_rate.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.Special.Bajarbhav.CropRate.edit',['cropType' => $cropType, 'cropName' => $cropName, 'update' => $update]);
    }

    public function delete($id) {
        $delete_rate = CropRate::where('id', $id)->delete();

        if ($delete_rate) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
    
}
