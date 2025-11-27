<?php

namespace App\Http\Controllers\Admin\VillageInfo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Taluka;
use App\Models\Village;
use App\Models\VillageNew;
use App\Models\VillageInfo\VillagePopulationCategory;
use App\Models\VillageInfo\VillageStatistics;
use App\Models\VillageInfo\VillageFacility;
use App\Models\User;
use DataTables;
use Carbon\Carbon;

class VillageController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.VillageInfo.Village.index');
    }

    public function getVillageData(){
        
        // $data = Village::with('taluka:id,en_name')->select('id', 'taluka_id', 'en_name', 'gram_panchayat_name', 'views', 'is_active', 'deleted_at')
        // ->orderBy('is_active', 'asc')
        // ->orderBy('id', 'desc')
        // ->withTrashed();
        
        $data = Village::with('taluka:id,en_name')
            ->leftJoin('talukas', 'villages.taluka_id', '=', 'talukas.id')
            ->select(
                'villages.id',
                'villages.taluka_id',
                'villages.en_name',
                'villages.gram_panchayat_name',
                'villages.views',
                'villages.is_active',
                'villages.deleted_at',
                'talukas.en_name as taluka_name'
            )
            ->orderBy('villages.is_active', 'asc')
            ->orderBy('villages.id', 'desc')
            ->withTrashed();

        return DataTables::of($data)
                        // ->addColumn('taluka_name', function ($data) {
                        //     return !empty($data->taluka->en_name) ? $data->taluka->en_name : '';
                        // })
                        ->editColumn('taluka_name', function ($data) {
                            return $data->taluka_name ?? '';
                        })
                        ->filterColumn('taluka_name', function ($query, $keyword) {
                            $query->where('talukas.en_name', 'like', "%{$keyword}%");
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
                                return '<a class="restore_row font-size-16" data-value = "' . route('admin.village.villageRestore', ['id' => $data->id]) . '" title = "Restore"><i class="icon-undo"></i></a>';
                            }else{
                                return '<a class="font-size-16" href="' . route('admin.village.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.village.villagedelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>
                                
                                <a class="font-size-16" href = "' . route('admin.village.view', ['id' => base64_encode($data->id)]) . '" title = "View"><i class="icon-eye-plus"></i></a>';
                            }
                        })
                        ->rawColumns(['taluka_name', 'active', 'action'])
                        ->addIndexColumn()
                        ->toJson();
    }
    
    public function add(Request $request) {

        return view('Admin.VillageInfo.Village.add');
    }

    public function save(Request $request) {
        
        if ($request->isMethod('post')) {

            // Step 1: Split by comma
            $names = array_map('trim', explode(',', $request->en_name)); // Trim whitespace

            foreach ($names as $name) {

                $village = new Village();
                $village->taluka_id = $request->taluka_id;
                $village->en_name = ucwords(strtolower($name));
                $village->village_slug = Str::slug($name);
                $village->content_updated_at = now();
                $village->is_active = 0;
                $village->save();

            }

            // $village->is_active = 0;
            // $village->save();
            
            if ($village) {
                return redirect()->route('admin.village.addVillage')->with('success', 'Village is successfully save');
            } else {
                return redirect()->route('admin.village.addVillage')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.VillageInfo.Village.index');
        }
    }
    
    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = Village::with('taluka:id,district_id','villagefacilities','villagestatistics')->where('id', $id)->first();

        $districtId = $update->taluka->district_id;
        
        $taluka_lists = Taluka::select('id', 'district_id', 'en_name')
        ->where('district_id', $districtId)
        ->get();

        $village_population_categories = VillagePopulationCategory::select('id','category_name')->get();

        if ($request->isMethod('post')) {

            $update->taluka_id = $request->taluka_id;
            $update->en_name = $request->en_name;
            $update->mr_name = $request->mr_name;
            $update->village_slug = $request->village_slug;
            $update->gram_panchayat_name = $request->gram_panchayat_name;
            
            $update->latitude = $request->latitude;
            $update->longitude = $request->longitude;

            $update->area = $request->area;
            $update->population = $request->population;
            $update->pincode = $request->pincode;

            $update->sex_ratio = $request->sex_ratio;
            $update->village_code = $request->village_code;
            $update->panchayat_code = $request->panchayat_code;
            $update->total_households = $request->total_households;
            $update->content_updated_at = now();
            
            $update->save();

            if ($update) {

                VillageFacility::where('village_id', $id)->update([
                    'public_bus' => $request->public_bus,
                    'railway_station' => $request->railway_station,
                    'communication' => $request->communication,
                    'electricity_supply' => $request->electricity_supply,
                    'domestic_electricity' => $request->domestic_electricity,
                    'agri_electricity' => $request->agri_electricity,
                    'other_electricity_uses' => $request->other_electricity_uses,
                    'all_households_electrified' => $request->all_households_electrified,
                    'primary_school' => $request->primary_school,
                    'primary_school_name' => $request->primary_school_name,
                    'secondary_school' => $request->secondary_school,
                    'secondary_school_name' => $request->secondary_school_name,
                    'college' => $request->college,
                    'college_name' => $request->college_name,
                    'hospital_facility' => $request->hospital_facility,
                    'primary_health_centre' => $request->primary_health_centre,
                    'other_medical_centres' => $request->other_medical_centres,
                    'tap_water' => $request->tap_water,
                    'well' => $request->well,
                    'tank' => $request->tank,
                    'tubewell' => $request->tubewell,
                    'handpump' => $request->handpump,
                    'other_sources' => $request->other_sources
                ]);

                foreach ($request->input('statistics') as $stat) {
                    VillageStatistics::updateOrCreate(
                        [
                            'village_id' => $id,
                            'category_id' => $stat['category_id'],
                        ],
                        [
                            'total' => $stat['total'] ?? 0,
                            'male' => $stat['male'] ?? 0,
                            'female' => $stat['female'] ?? 0,
                        ]
                    );
                }

                return redirect()->route('admin.village.index')->with('success', 'Village is successfully updated');
            } else {
                return redirect()->route('admin.village.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.VillageInfo.Village.edit',['taluka_lists' => $taluka_lists, 'update' => $update, 'village_population_categories' => $village_population_categories]);
    }

    public function view($id) {
        
        $id = base64_decode($id);

        $view = Village::with('taluka:id,en_name','villagefacilities','villagestatistics')->where('id', $id)->first();

        $village_population_categories = VillagePopulationCategory::select('id','category_name')->get();

        return view('Admin.VillageInfo.Village.view',['view' => $view, 'village_population_categories' => $village_population_categories]);
    }
    
    public function villageSlugCheck() {

        $village_slug = Str::slug($_GET['village_slug']);

        $slug = Village::where(['village_slug' => $village_slug])->count();

        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }
    
    public function villageSlugCheckUpdate($id) {
        
        $village_slug = Str::slug($_GET['village_slug']);

        $slug = Village::where(['village_slug' => $village_slug])->where('id', '!=', $id)->count();

        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function status($id, $status) {

        $village_status = Village::where('id', $id)->update(array('is_active' => $status));

        if ($village_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {

        $delete_village = Village::where('id', $id)->delete();

        if ($delete_village) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

    public function restore($id) {

        $record = Village::onlyTrashed()->find($id);

        if ($record) {
            $record->restore();
            return response()->json(['message' => 'Village Record restored successfully!']);
        }

        return response()->json(['message' => 'Record not found!'], 404);
    }
    
    public function resetViews() {

        $reset_views = Village::query()->update([
            'views' => DB::raw('GREATEST(0, views - 2)')
        ]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
