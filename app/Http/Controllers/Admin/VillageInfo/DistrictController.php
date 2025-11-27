<?php

namespace App\Http\Controllers\Admin\VillageInfo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\State;
use App\Models\District;
use DataTables;
use Carbon\Carbon;

class DistrictController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.VillageInfo.District.index');
    }

    public function getDistrictData(){
        
        // $data = District::with('state:id,en_name')->select('id', 'state_id', 'en_name', 'total_tahsils', 'total_villages', 'views', 'is_active', 'deleted_at')
        // ->orderBy('is_active', 'desc')
        // ->orderBy('id', 'asc')->withTrashed();
        
        $data = District::with('state:id,en_name')
            ->leftJoin('states', 'districts.state_id', '=', 'states.id')
            ->select(
                'districts.id',
                'districts.state_id',
                'districts.en_name',
                'districts.total_tahsils',
                'districts.total_villages',
                'districts.views',
                'districts.is_active',
                'districts.deleted_at',
                'states.en_name as state_name'
            )
            ->orderBy('districts.is_active', 'desc')
            ->orderBy('districts.id', 'asc')
            ->withTrashed();

        return DataTables::of($data)
                        // ->addColumn('state_name', function ($data) {
                        //     return !empty($data->state->en_name) ? $data->state->en_name : '';
                        // })
                        ->editColumn('state_name', function ($data) {
                            return $data->state_name ?? '';
                        })
                        ->filterColumn('state_name', function ($query, $keyword) {
                            $query->where('states.en_name', 'like', "%{$keyword}%");
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
                                return '<a class="restore_row font-size-16" data-value = "' . route('admin.district.districtRestore', ['id' => $data->id]) . '" title = "Restore"><i class="icon-undo"></i></a>';
                            }else{
                                return '<a class="font-size-16" href="' . route('admin.district.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.district.districtdelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>
                                
                                <a class="font-size-16" href = "' . route('admin.district.view', ['id' => base64_encode($data->id)]) . '" title = "View"><i class="icon-eye-plus"></i></a>';
                            }
                        })
                        ->rawColumns(['state_name', 'active', 'action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {

        $state_lists = State::active()->select('id', 'en_name')->get();

        return view('Admin.VillageInfo.District.add', ['state_lists' => $state_lists]);
    }

    public function save(Request $request) {
        
        if ($request->isMethod('post')) {

            $district = new District();

            $district->state_id = $request->state_id;
            $district->en_name = $request->en_name;
            $district->mr_name = $request->mr_name;
            $district->district_slug = $request->district_slug;
            $district->area = $request->area;
            $district->population = $request->population;

            $district->density = $request->density;
            $district->total_tahsils = $request->total_tahsils;
            $district->total_villages = $request->total_villages;
            $district->sex_ratio = $request->sex_ratio;

            $district->rural_household = $request->rural_household;
            $district->urban_household = $request->urban_household;
            $district->total_households = $request->total_households;

            $district->population_1 = $request->population_1;
            $district->population_2 = $request->population_2;
            $district->population_3 = $request->population_3;
            $district->population_4 = $request->population_4;
            $district->population_5 = $request->population_5;
            $district->population_6 = $request->population_6;
            $district->population_7 = $request->population_7;

            $district->male_rural = $request->male_rural;
            $district->male_urban = $request->male_urban;
            $district->female_rural = $request->female_rural;
            $district->female_urban = $request->female_urban;
            $district->rural_total = $request->rural_total;
            $district->urban_total = $request->urban_total;

            $district->nearest_districts = $request->nearest_districts;
            $district->std_code = $request->std_code;
            
            $district->total_banks = $request->total_banks;
            $district->total_hospitals = $request->total_hospitals;
            $district->total_mahavitarans = $request->total_mahavitarans;
            $district->total_police_stations = $request->total_police_stations;
            $district->total_taluka_wise_schools = $request->total_taluka_wise_schools;
            $district->total_municipalities = $request->total_municipalities;
            $district->total_postal = $request->total_postal;
            $district->total_universities = $request->total_universities;
            $district->official_website = $request->official_website;
            $district->content_updated_at = now();

            $district->is_active = 0;
            $district->save();
            
            if ($district) {
                return redirect()->route('admin.district.index')->with('success', 'District is successfully save');
            } else {
                return redirect()->route('admin.district.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.VillageInfo.District.index');
        }
    }

    public function edit($id, Request $request) {
        
        $id = base64_decode($id);

        $state_lists = State::active()->select('id', 'en_name')->get();

        $update = District::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->state_id = $request->state_id;
            $update->en_name = $request->en_name;
            $update->mr_name = $request->mr_name;
            $update->district_slug = $request->district_slug;
            
            $update->area = $request->area;
            $update->population = $request->population;
            $update->density = $request->density;

            $update->sex_ratio = $request->sex_ratio;
            $update->total_villages = $request->total_villages;
            $update->total_tahsils = $request->total_tahsils;
            $update->total_villages = $request->total_villages;
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

            $update->nearest_districts = $request->nearest_districts;
            $update->std_code = $request->std_code;

            $update->total_banks = $request->total_banks;
            $update->total_hospitals = $request->total_hospitals;
            $update->total_mahavitarans = $request->total_mahavitarans;
            $update->total_police_stations = $request->total_police_stations;
            $update->total_taluka_wise_schools = $request->total_taluka_wise_schools;
            $update->total_municipalities = $request->total_municipalities;
            $update->total_postal = $request->total_postal;
            $update->total_universities = $request->total_universities;
            $update->official_website = $request->official_website;
            $update->content_updated_at = now();
            
            $update->save();

            if ($update) {
                return redirect()->route('admin.district.index')->with('success', 'District is successfully updated');
            } else {
                return redirect()->route('admin.district.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.VillageInfo.District.edit',['state_lists' => $state_lists, 'update' => $update]);
    }

    public function view($id, Request $request) {
        
        $id = base64_decode($id);
        $view = District::with('state:id,en_name')->where('id', $id)->first();

        return view('Admin.VillageInfo.District.view',['view' => $view]);
    }

    public function districtSlugCheck() {

        $district_slug = Str::slug($_GET['district_slug']);

        $slug = District::where(['district_slug' => $district_slug])->count();

        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function districtSlugCheckUpdate($id) {
        
        $district_slug = Str::slug($_GET['district_slug']);

        $slug = District::where(['district_slug' => $district_slug])->where('id', '!=', $id)->count();

        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function status($id, $status) {

        $district_status = District::where('id', $id)->update(array('is_active' => $status));

        if ($district_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {

        $delete_district = District::where('id', $id)->delete();

        if ($delete_district) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

    public function restore($id) {

        $record = District::onlyTrashed()->find($id);

        if ($record) {
            $record->restore();
            return response()->json(['message' => 'District Record restored successfully!']);
        }

        return response()->json(['message' => 'Record not found!'], 404);
    }
    
    public function resetViews() {

        $reset_views = District::query()->update([
            'views' => DB::raw('GREATEST(0, views - 2)')
        ]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
