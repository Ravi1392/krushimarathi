<?php

namespace App\Http\Controllers\Admin\VillageInfo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\State;
use App\Models\Country;
use App\Models\User;
use DataTables;
use Carbon\Carbon;

class StateController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.VillageInfo.State.index');
    }

    public function getStateData(){
        
        $data = State::select('id', 'code', 'en_name', 'capital_name', 'established', 'total_villages', 'views', 'is_active', 'deleted_at')
        ->orderBy('is_active', 'desc')
        ->orderBy('id', 'asc')->withTrashed();

        return DataTables::of($data)
                        ->editColumn('established', function ($data) {
                            return $data->established ? Carbon::parse($data->established)->format('j-M-Y') : 'N/A';
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
                                return '<a class="restore_row font-size-16" data-value = "' . route('admin.state.stateRestore', ['id' => $data->id]) . '" title = "Restore"><i class="icon-undo"></i></a>';
                            }else{
                                return '<a class="font-size-16" href="' . route('admin.state.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.state.statedelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>
                                
                                <a class="font-size-16" href = "' . route('admin.state.view', ['id' => base64_encode($data->id)]) . '" title = "View"><i class="icon-eye-plus"></i></a>';
                            }
                        })
                        ->rawColumns(['active', 'action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {

        $country_lists = Country::active()->select('id', 'name')->get();

        return view('Admin.VillageInfo.State.add', ['country_lists' => $country_lists]);
    }

    public function save(Request $request) {
        
        if ($request->isMethod('post')) {
            $state = new State();

            $state->country_id = $request->country_id;
            $state->census_code = $request->census_code;
            $state->code = $request->code;
            $state->en_name = $request->en_name;
            $state->mr_name = $request->mr_name;
            $state->state_slug = $request->state_slug;
            $state->capital_name = $request->capital_name;
            $state->established = $request->established;

            $state->total_area = $request->total_area;
            $state->type = $request->type;
            $state->total_villages = $request->total_villages;
            $state->sex_ratio = $request->sex_ratio;
            $state->rural_density = $request->rural_density;
            $state->urban_density = $request->urban_density;
            $state->population_density = $request->population_density;
            $state->court = $request->court;

            $state->total_population = $request->total_population;
            $state->rural_household = $request->rural_household;
            $state->urban_household = $request->urban_household;
            $state->total_households = $request->total_households;

            $state->population_1 = $request->population_1;
            $state->population_2 = $request->population_2;
            $state->population_3 = $request->population_3;
            $state->population_4 = $request->population_4;
            $state->population_5 = $request->population_5;
            $state->population_6 = $request->population_6;
            $state->population_7 = $request->population_7;

            $state->male_rural = $request->male_rural;
            $state->male_urban = $request->male_urban;
            $state->female_rural = $request->female_rural;
            $state->female_urban = $request->female_urban;
            $state->rural_total = $request->rural_total;
            $state->urban_total = $request->urban_total;
            $state->nearest_states = $request->nearest_states;
            $state->about_us = $request->about_us;
            $state->content_updated_at = now();

            $state->is_active = 0;
            $state->save();
            
            if ($state) {
                return redirect()->route('admin.state.index')->with('success', 'State is successfully save');
            } else {
                return redirect()->route('admin.state.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.VillageInfo.State.index');
        }
    }

    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $country_lists = Country::active()->select('id', 'name')->get();
        $update = State::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->country_id = $request->country_id;
            $update->census_code = $request->census_code;
            $update->en_name = $request->en_name;
            $update->mr_name = $request->mr_name;
            $update->state_slug = $request->state_slug;
            $update->capital_name = $request->capital_name;
            $update->code = $request->code;
            $update->established = $request->established;
            $update->sex_ratio = $request->sex_ratio;
            $update->total_villages = $request->total_villages;
            $update->total_area = $request->total_area;
            $update->population_density = $request->population_density;
            $update->court = $request->court;
            $update->total_population = $request->total_population;
            $update->rural_density = $request->rural_density;
            $update->urban_density = $request->urban_density;
            $update->rural_household = $request->rural_household;
            $update->urban_household = $request->urban_household;
            $update->total_households = $request->total_households;
            $update->type = $request->type;

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

            $update->nearest_states = $request->nearest_states;
            $update->about_us = $request->about_us;
            $update->content_updated_at = now();
            
            $update->save();

            if ($update) {
                return redirect()->route('admin.state.index')->with('success', 'State is successfully updated');
            } else {
                return redirect()->route('admin.state.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.VillageInfo.State.edit',['country_lists' => $country_lists, 'update' => $update]);
    }

    public function view($id, Request $request) {
        
        $id = base64_decode($id);
        $view = State::with('country:id,name')->where('id', $id)->first();

        return view('Admin.VillageInfo.State.view',['view' => $view]);
    }

    public function stateSlugCheck() {

        $state_slug = Str::slug($_GET['state_slug']);

        $slug = State::where(['state_slug' => $state_slug])->count();

        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function stateSlugCheckUpdate($id) {
        
        $state_slug = Str::slug($_GET['state_slug']);

        $slug = State::where(['state_slug' => $state_slug])->where('id', '!=', $id)->count();

        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }


    public function status($id, $status) {

        $state_status = State::where('id', $id)->update(array('is_active' => $status));

        if ($state_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {

        $delete_state = State::where('id', $id)->delete();

        if ($delete_state) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

    public function restore($id) {

        $record = State::onlyTrashed()->find($id);

        if ($record) {
            $record->restore(); // Restore the deleted record
            return response()->json(['message' => 'State Record restored successfully!']);
        }

        return response()->json(['message' => 'Record not found!'], 404);
    }
    
    public function resetViews() {

        $reset_views = State::query()->update([
            'views' => DB::raw('GREATEST(0, views - 2)')
        ]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
