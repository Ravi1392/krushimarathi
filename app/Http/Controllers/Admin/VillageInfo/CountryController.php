<?php

namespace App\Http\Controllers\Admin\VillageInfo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\User;
use Auth;
use DataTables;

class CountryController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.VillageInfo.Country.index');
    }

    public function getCountryData(){

        $data = Country::select('id', 'code', 'name', 'capital_name', 'country_code', 'total_villages', 'views', 'is_active', 'deleted_at')
        ->orderBy('is_active', 'desc')
        ->orderBy('id', 'asc')->withTrashed();

        return DataTables::of($data)
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
                                return '<a class="restore_row font-size-16" data-value = "' . route('admin.country.countryRestore', ['id' => $data->id]) . '" title = "Restore"><i class="icon-undo"></i></a>';
                            }else{
                                return '<a class="font-size-16" href="' . route('admin.country.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.country.categorydelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>
                                
                                <a class="font-size-16" href = "' . route('admin.country.view', ['id' => base64_encode($data->id)]) . '" title = "View"><i class="icon-eye-plus"></i></a>';
                            }
                        })
                        ->rawColumns(['active', 'action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        return view('Admin.VillageInfo.Country.add');
    }

    public function save(Request $request) {
        
        if ($request->isMethod('post')) {
            $country = new Country();

            $country->country_code = $request->country_code;
            $country->code = $request->code;
            $country->name = $request->name;
            $country->capital_name = $request->capital_name;
            $country->total_towns = $request->total_towns ?? 0;
            $country->total_villages = $request->total_villages ?? 0;
            $country->total_area = $request->total_area;
            $country->households = $request->households;
            $country->population_density = $request->population_density;
            $country->court = $request->court;
            $country->male_population = $request->male_population;
            $country->female_population = $request->female_population;
            $country->total_population = $request->total_population;
            $country->inhabited = $request->inhabited;
            $country->uninhabited = $request->uninhabited;
            $country->population_1 = $request->population_1;
            $country->population_2 = $request->population_2;
            $country->population_3 = $request->population_3;
            $country->population_4 = $request->population_4;
            $country->population_5 = $request->population_5;
            $country->population_6 = $request->population_6;
            $country->population_7 = $request->population_7;
            $country->content_updated_at = now();
            $country->is_active = 0;
            $country->save();
            
            if ($country) {
                return redirect()->route('admin.country.index')->with('success', 'Country is successfully save');
            } else {
                return redirect()->route('admin.country.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.VillageInfo.Country.index');
        }
    }

    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = Country::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->name = $request->name;
            $update->capital_name = $request->capital_name;
            $update->code = $request->code;
            $update->country_code = $request->country_code;
            $update->total_towns = $request->total_towns;
            $update->total_villages = $request->total_villages;
            $update->total_area = $request->total_area;
            $update->households = $request->households;
            $update->population_density = $request->population_density;
            $update->court = $request->court;
            $update->male_population = $request->male_population;
            $update->female_population = $request->female_population;
            $update->total_population = $request->total_population;
            $update->inhabited = $request->inhabited;
            $update->uninhabited = $request->uninhabited;
            $update->population_1 = $request->population_1;
            $update->population_2 = $request->population_2;
            $update->population_3 = $request->population_3;
            $update->population_4 = $request->population_4;
            $update->population_5 = $request->population_5;
            $update->population_6 = $request->population_6;
            $update->population_7 = $request->population_7;
            $update->content_updated_at = now();
            $update->save();

            if ($update) {
                return redirect()->route('admin.country.index')->with('success', 'Country is successfully updated');
            } else {
                return redirect()->route('admin.country.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.VillageInfo.Country.edit',['update' => $update]);
    }

    public function view($id, Request $request) {
        
        $id = base64_decode($id);
        $view = Country::where('id', $id)->first();

        return view('Admin.VillageInfo.Country.view',['view' => $view]);
    }

    public function status($id, $status) {

        $country_status = Country::where('id', $id)->update(array('is_active' => $status));
        if ($country_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {

        $delete_country = Country::where('id', $id)->delete();

        if ($delete_country) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

    public function restore($id)
    {
        $record = Country::onlyTrashed()->find($id);

        if ($record) {
            $record->restore(); // Restore the deleted record
            return response()->json(['message' => 'Country Record restored successfully!']);
        }

        return response()->json(['message' => 'Record not found!'], 404);
    }
    
    public function resetViews() {

        $reset_views = Country::query()->update([
            'views' => DB::raw('GREATEST(0, views - 2)')
        ]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
