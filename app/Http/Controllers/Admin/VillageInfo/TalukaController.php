<?php

namespace App\Http\Controllers\Admin\VillageInfo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Taluka;
use App\Models\District;
use App\Models\User;
use DataTables;
use Carbon\Carbon;

class TalukaController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.VillageInfo.Taluka.index');
    }

    public function getTalukaData(){
        
        // $data = Taluka::with('district:id,en_name')->select('id', 'district_id', 'en_name', 'total_villages', 'views', 'is_active', 'deleted_at')
        // ->orderBy('is_active', 'desc')
        // ->orderBy('id', 'asc')->withTrashed();

        $data = Taluka::with('district:id,en_name')
                ->leftJoin('districts', 'talukas.district_id', '=', 'districts.id')
                ->select('talukas.id','talukas.district_id','talukas.en_name','talukas.total_villages','talukas.views','talukas.is_active','talukas.deleted_at','districts.en_name as district_name')
                ->orderBy('talukas.is_active', 'desc')
                ->orderBy('talukas.id', 'asc')
                ->withTrashed();

        return DataTables::of($data)
                        // ->addColumn('district_name', function ($data) {
                        //     return !empty($data->district->en_name) ? $data->district->en_name : '';
                        // })
                        ->editColumn('district_name', function ($data) {
                            return $data->district_name ?? '';
                        })
                        ->filterColumn('district_name', function ($query, $keyword) {
                            $query->where('districts.en_name', 'like', "%{$keyword}%");
                        })
                        ->addColumn('active', function ($data) {
                            if($data->deleted_at != null){
                                return '';
                            }else{
                                $checked = ($data->is_active == 1) ? 'checked' : '';
                                return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch" data-size="sm" ' . $checked . '  />';
                            }
                        })
                        ->addColumn('action', function($data) {

                            if($data->deleted_at != null){
                                return '<a class="restore_row font-size-16" data-value = "' . route('admin.taluka.talukaRestore', ['id' => $data->id]) . '" title = "Restore"><i class="icon-undo"></i></a>';
                            }else{
                                return '<a class="font-size-16" href="' . route('admin.taluka.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.taluka.talukadelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>
                                
                                <a class="font-size-16" href = "' . route('admin.taluka.view', ['id' => base64_encode($data->id)]) . '" title = "View"><i class="icon-eye-plus"></i></a>';
                            }
                        })
                        ->rawColumns(['district_name', 'active', 'action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {

        $district_lists = District::active()->select('id', 'en_name')->get();

        return view('Admin.VillageInfo.Taluka.add', ['district_lists' => $district_lists]);
    }
    
    public function save(Request $request) {
        
        if ($request->isMethod('post')) {

            $taluka = new Taluka();

            // Step 1: Split by comma
            // $names = array_map('trim', explode(',', $request->en_name)); // Trim whitespace

            // foreach ($names as $name) {

            //     $taluka = new Taluka();
            //     $taluka->district_id = $request->district_id;
            //     $taluka->en_name = ucwords(strtolower($name));
            //     $taluka->total_villages = 0;
            //     $taluka->taluka_slug = Str::slug($name);
            //     $taluka->is_active = 0;
            //     $taluka->save();

            // }

            $taluka->district_id = $request->district_id;
            $taluka->en_name = $request->en_name;
            $taluka->mr_name = $request->mr_name;
            $taluka->taluka_slug = Str::slug($request->taluka_slug);

            $taluka->latitude = $request->latitude;
            $taluka->longitude = $request->longitude;
            $taluka->area = $request->area;
            $taluka->population = $request->population;

            $taluka->density = $request->density;
            $taluka->total_villages = $request->total_villages ?? 0;
            $taluka->sex_ratio = $request->sex_ratio;

            $taluka->rural_household = $request->rural_household;
            $taluka->urban_household = $request->urban_household;
            $taluka->total_households = $request->total_households;

            $taluka->population_1 = $request->population_1;
            $taluka->population_2 = $request->population_2;
            $taluka->population_3 = $request->population_3;
            $taluka->population_4 = $request->population_4;
            $taluka->population_5 = $request->population_5;
            $taluka->population_6 = $request->population_6;
            $taluka->population_7 = $request->population_7;

            $taluka->male_rural = $request->male_rural;
            $taluka->male_urban = $request->male_urban;
            $taluka->female_rural = $request->female_rural;
            $taluka->female_urban = $request->female_urban;
            $taluka->rural_total = $request->rural_total;
            $taluka->urban_total = $request->urban_total;

            $taluka->nearest_talukas = $request->nearest_talukas;
            $taluka->std_code = $request->std_code;
            $taluka->pin_code = $request->pin_code;
            $taluka->content_updated_at = now();

            $taluka->is_active = 0;
            $taluka->save();
            
            if ($taluka) {
                return redirect()->route('admin.taluka.index')->with('success', 'Taluka is successfully save');
            } else {
                return redirect()->route('admin.taluka.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.VillageInfo.Taluka.index');
        }
    }

    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = Taluka::with('district:id,id,state_id')->where('id', $id)->first();

        $stateId = $update->district->state_id;

        $district_lists = District::select('id', 'state_id', 'en_name')
        ->where('state_id', $stateId)
        ->get();

        if ($request->isMethod('post')) {

            $update->district_id = $request->district_id;
            $update->en_name = $request->en_name;
            $update->mr_name = $request->mr_name;
            $update->taluka_slug = $request->taluka_slug;
            
            $update->latitude = $request->latitude;
            $update->longitude = $request->longitude;

            $update->area = $request->area;
            $update->population = $request->population;
            $update->density = $request->density;

            $update->sex_ratio = $request->sex_ratio;
            $update->total_villages = $request->total_villages ?? 0;
            $update->rural_household = $request->rural_household;
            $update->urban_household = $request->urban_household;
            $update->total_households = $request->total_households;
        
            $update->population_1 = $request->population_1;
            $update->population_2 = $request->population_2;
            $update->population_3 = $request->population_3;
            $update->population_4 = $request->population_4;
            $update->population_5 = $request->population_5;
            $update->population_6 = $request->population_6;
            $update->population_7 = $request->population_7;

            $update->male_rural = $request->male_rural;
            $update->male_urban = $request->male_urban;
            $update->female_rural = $request->female_rural;
            $update->female_urban = $request->female_urban;
            $update->rural_total = $request->rural_total;
            $update->urban_total = $request->urban_total;

            $update->nearest_talukas = $request->nearest_talukas;
            $update->std_code = $request->std_code;
            $update->pin_code = $request->pin_code;
            $update->content_updated_at = now();
            
            $update->save();

            if ($update) {
                return redirect()->route('admin.taluka.index')->with('success', 'Taluka is successfully updated');
            } else {
                return redirect()->route('admin.taluka.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.VillageInfo.Taluka.edit',['district_lists' => $district_lists, 'update' => $update]);
    }

    public function view($id, Request $request) {
        
        $id = base64_decode($id);
        $view = Taluka::with('district:id,en_name')->where('id', $id)->first();

        return view('Admin.VillageInfo.Taluka.view',['view' => $view]);
    }

    public function talukaSlugCheck() {

        $taluka_slug = Str::slug($_GET['taluka_slug']);

        $slug = Taluka::where(['taluka_slug' => $taluka_slug])->count();

        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }
    
    public function talukaSlugCheckUpdate($id) {
        
        $taluka_slug = Str::slug($_GET['taluka_slug']);

        $slug = Taluka::where(['taluka_slug' => $taluka_slug])->where('id', '!=', $id)->count();

        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function status($id, $status) {

        $taluka_status = Taluka::where('id', $id)->update(array('is_active' => $status));

        if ($taluka_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {

        $delete_taluka = Taluka::where('id', $id)->delete();

        if ($delete_taluka) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

    public function restore($id) {

        $record = Taluka::onlyTrashed()->find($id);

        if ($record) {
            $record->restore();
            return response()->json(['message' => 'Taluka Record restored successfully!']);
        }

        return response()->json(['message' => 'Record not found!'], 404);
    }
    
    public function resetViews() {

        $reset_views = Taluka::query()->update([
            'views' => DB::raw('GREATEST(0, views - 2)')
        ]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
