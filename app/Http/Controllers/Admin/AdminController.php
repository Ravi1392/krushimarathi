<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;

class AdminController extends Controller {

    public function __construct() {
        
    }
    
    public function index() {
        return view('Admin.ManageAdmin.index');
    }

    
    public function emailcheck() {
       // $user = Auth::user();

        $user = User::where(['email' => $_GET['email']])->count();
        if ($user != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }
    public function emailCheckUpdate($id) {
        
        $user = User::where(['email' => $_GET['email']])->where('id', '!=', $id)->count();
        if ($user != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }
    public function status($id, $status) {
       
        $set_status = User::where('id', $id)->update(array('is_active' => $status));
        if ($set_status) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function profile() {
        $user = Auth::user();
        return view('Admin.ManageAdmin.profile',['user' => $user]);
    }
    public function updateProfile(Request $request) {
        $user = Auth::user();
        $update = User::find($user->id);
        $update->name = $request->name;
        $update->last_name = $request->last_name;
        $update->phone = $request->phone;
       
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $imagePath = public_path('/assets/admin/images/profile/');
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0775, true);
            }
            $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image->move($imagePath, $imageName);
            $update->profile = $imageName;
        }

        $update->save();
        if ($update) {
            return redirect()->route('admin.profile')->with('success', 'Profile is successfully updated');
        } else {
            return redirect()->route('admin.profile')->with('error', 'something went wrong.');
        }
    }
    public function updatePassword(Request $request) {
        $user = Auth::user();
        $data = User::find($user->id);

         if (Hash::check($request->old_pass, $user->password)) {

            if ($request->new_pass != $request->confirm_pass) {
                return redirect()->route('admin.profile')->with('error', 'Password and confirm password does not match!');
            }

            if (isset($data) && !empty($data)) {
                if($request->old_pass != $request->new_pass){
                    $data->password = Hash::make($request->new_pass);
                    $data->save();
                    return redirect()->route('admin.profile')->with('success', 'Password successfully changed!');
                }else{
                    return redirect()->route('admin.profile')->with('error', 'Current password and new password does not same');
                }
            } else {
                return redirect()->route('admin.profile')->with('error', 'Something went wrong!');
            }
        } else {
            return redirect()->route('admin.profile')->with('error', 'Current password does not match!');
        }
         
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
   }

}
