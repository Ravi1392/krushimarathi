<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MobileUser;
use Auth;
use DataTables;

class MobileUserController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.MobileUser.index');
    }

    public function getMobileUserData() {
        
        $data = MobileUser::orderBy('id', 'desc');
        
        return DataTables::of($data)
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addColumn('action', function($data) {
                            return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.mobile_user.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                            
                            <a class="delete_row font-size-16" data-value = "' . route('admin.mobile_user.mobileUserDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        return view('Admin.MobileUser.add');
    }

    public function save(Request $request) {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $mobile_user = new MobileUser();
            $mobile_user->name = $request->name;
            $mobile_user->mobile = $request->mobile;
            $mobile_user->save();
            
            if ($mobile_user) {
                return redirect()->route('admin.mobile_user.index')->with('success', 'Mobile user is successfully save');
            } else {
                return redirect()->route('admin.mobile_user.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.MobileUser.index');
        }
    }

    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = MobileUser::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->name = $request->name;
            $update->mobile = $request->mobile;
            $update->save();
            if ($update) {
                return redirect()->route('admin.mobile_user.index')->with('success', 'Mobile user is successfully updated');
            } else {
                return redirect()->route('admin.mobile_user.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.MobileUser.edit',['update' => $update]);
    }

    public function mobileUserCheck() {

        $mobile_user = MobileUser::where(['mobile' => $_GET['mobile']])->count();
        if ($mobile_user != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function mobileUserCheckUpdate($id) {
        
        $mobile_user = MobileUser::where(['mobile' => $_GET['mobile']])->where('id', '!=', $id)->count();
        if ($mobile_user != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function delete($id) {
        $delete_mobile_user = MobileUser::where('id', $id)->delete();

        if ($delete_mobile_user) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

}
