<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use Carbon\Carbon;
use Validator;
use Auth;


class SettingController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        $setting_update = Setting::whereIN('key',['google_ads','google_tag','adscode','ad_blocking_recovery'])->get();
        return view('Admin.Setting.index',['setting_update' => $setting_update]);
    }
    
    public function add(Request $request) {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $data = $request->all();
            $setting = 0;
            foreach ($data as $key => $data_val) {
                Setting::where('key', $key)->update(array('value' => $data_val));
                $setting = 1;
            }
            if ($setting) {
                return redirect()->route('admin.setting.index')->with('success', 'Setting is successfully save');
            } else {
                return redirect()->route('admin.setting.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.Setting.index');
        }
    }
}
