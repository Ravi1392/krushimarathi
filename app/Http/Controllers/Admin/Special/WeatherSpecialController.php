<?php

namespace App\Http\Controllers\Admin\Special;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\WeatherSpecial;
use DataTables;
use Validator;
use Auth;

class WeatherSpecialController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Special.Weather.index');
    }

    public function getWeatherData(){
        
        $data = WeatherSpecial::with('district:id,mr_name,en_name')->orderBy('id', 'asc');

        return DataTables::of($data)
                        ->addColumn('city_name', function ($request) {
                            return $request->district->mr_name .'  ('. $request->district->en_name .')';
                        })
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addColumn('active', function ($data) {
                            $checked = ($data->is_active == 1) ? 'checked' : '';
                            return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch" data-size="sm" ' . $checked . '  />';
                        })
                        ->addColumn('action', function($data) {
                            return '<a class="font-size-16" href="' . route('admin.weather.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.weather.weatherDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                        })
                        ->rawColumns(['active', 'action', 'city_name'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = WeatherSpecial::with('district:id,mr_name,en_name')->where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->aqi_value = $request->aqi_value;
            $update->aqi_class = $request->aqi_class;
            $update->aqi_image = $request->aqi_image;
            $update->temperature = $request->temperature;
            $update->weather_condition = $request->weather_condition;
            $update->weather_image = $request->weather_image;
            $update->save();
            if ($update) {
                return redirect()->route('admin.weather.index')->with('success', 'Weather is successfully updated');
            } else {
                return redirect()->route('admin.weather.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin/Special/Weather/edit',['update' => $update]);
    }

    public function status($id, $status) {

        $weather_special = WeatherSpecial::where('id', $id)->update(array('is_active' => $status));
        if ($weather_special) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {
        $delete_weather = WeatherSpecial::where('id', $id)->delete();

        if ($delete_weather) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
}
