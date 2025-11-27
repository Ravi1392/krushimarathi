<?php

namespace App\Http\Controllers\Advertisement\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Advertisement\Customer;
use App\Models\Advertisement\BusinessType;
use App\Models\State;
use Validator;
use Auth;
use Log;
use Mail;

class CustomerController extends Controller {

    public function __construct() {
        
    }
    
    public function phonecheck() {
       
        $customer = Customer::where(['phone' => $_GET['phone']])->count();
        if ($customer != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function phoneCheckUpdate($id) {
        
        $user = Customer::where(['phone' => $_GET['phone']])->where('id', '!=', $id)->count();
        if ($user != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function emailCheckUpdate($id) {
        
        $user = Customer::where(['email' => $_GET['email']])->where('id', '!=', $id)->count();
        if ($user != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function profile() {

        $lang = session('locale', 'en');

        $customer_data = Auth::guard('customer')->user();

        $customer = Customer::with([
                            "district:id,en_name",
                            "taluka:id,en_name",
                            "village:id,en_name"
                        ])
        ->where('id', '=', $customer_data->id)->first();

        $states = State::active()->select("id","en_name","mr_name")->orderBy('en_name', 'asc')->get();

        $business_types = BusinessType::select('id','en_name','hi_name','mr_name')
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($business_type) use ($lang) {
                $name = match($lang) {
                    'mr' => $business_type->mr_name ?: $business_type->en_name,
                    'hi' => $business_type->hi_name ?: $business_type->en_name,
                    default => $business_type->en_name,
                };
                $business_type->name = $name;
                return $business_type;
            });

        return view('advertisement.customer.profile',['user' => $customer, 'states' => $states, 'business_types' => $business_types]);
    }
    
    public function updateProfile(Request $request) {

        $customer = Auth::guard('customer')->user();

        $update = Customer::find($customer->id);
        $update->name = $request->name;
        $update->middle_name = $request->middle_name;
        $update->last_name = $request->last_name;
        $update->gender = $request->gender;
        $update->phone = $request->phone;
        $update->email = $request->email;
        $update->profile_desc = $request->profile_desc;
        $update->business_name = $request->business_name;
        $update->business_type_id = $request->business_type_id;
        $update->address = $request->address;
        $update->state_id = $request->state_id;
        $update->district_id = $request->district_id;
        $update->division_id = $request->division_id;
        $update->village_id = $request->village_id;
        $update->pincode = $request->pincode;
        
       
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $imagePath = public_path('/assets/advertisement/images/profile/');
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0775, true);
            }
            $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image->move($imagePath, $imageName);
            $update->profile = $imageName;
        }

        $update->save();
        if ($update) {
            return redirect()->route('ads.profile')->with('success', 'Profile is successfully updated');
        } else {
            return redirect()->route('ads.profile')->with('error', 'something went wrong.');
        }
    }

    public function updatePassword(Request $request) {

        $customer = Auth::guard('customer')->user();
        $data = Customer::find($customer->id);

         if (Hash::check($request->old_pass, $customer->password)) {

            if ($request->new_pass != $request->confirm_pass) {
                return redirect()->route('ads.profile')->with('error', 'Password and confirm password does not match!');
            }

            if (isset($data) && !empty($data)) {
                if($request->old_pass != $request->new_pass){
                    $data->password = Hash::make($request->new_pass);
                    $data->save();
                    return redirect()->route('ads.profile')->with('success', 'Password successfully changed!');
                }else{
                    return redirect()->route('ads.profile')->with('error', 'Current password and new password does not same');
                }
            } else {
                return redirect()->route('ads.profile')->with('error', 'Something went wrong!');
            }
        } else {
            return redirect()->route('ads.profile')->with('error', 'Current password does not match!');
        }
         
    }

    public function verifyOtp(Request $request) {

        $customer = Auth::guard('customer')->user();
        $data = Customer::find($customer->id);

        $enteredOtp = implode('', $request->otp);

        if (isset($data) && !empty($data)) {
            if($data->otp == $enteredOtp){

                $data->otp = NULL;
                $data->status = 'Verified';

                if($data->save()){
                    return redirect()->route('ads.dashboard')->with('success', 'OTP verified successfully! You can now proceed.');
                }else{
                    return redirect()->route('ads.dashboard')->with('error', 'Something went wrong!');
                }
            }else{
                return redirect()->route('ads.dashboard')->with('error', 'OTP expired or not found. Please request a new OTP.');
            }
        } else {
            return redirect()->route('ads.dashboard')->with('error', 'Something went wrong!');
        }
    }

    public function getPhone(Request $request)
    {
        $customer = Customer::find($request->customer_id);

        if (!$customer) {
            return response()->json(['status' => 'error', 'message' => 'Customer not found.'], 404);
        }

        return response()->json([
            'status' => 'success',
            'phone' => $customer->phone
        ]);
    }

    public function resendOtp(Request $request){

        $otp = generateRandomPassword();
        $customer = Auth::guard('customer')->user();

        $update = Customer::find($customer->id);
        $update->otp = $otp;
        
        if ($update->save()) {

            try {
                $this->sendotp_on_mail($update->email, $otp, $update->name, $update->last_name);
            } catch (\Exception $e) { 
                \Log::error('OTP email sending failed: ' . $e->getMessage(), [
                    'email' => $email,
                    'exception' => $e->getTraceAsString(), // Logs the full stack trace for detailed debugging
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]);
            }
            return response()->json(['status' => 'success', 'message' => __('otp.resend_success')]);
        } else {
            return response()->json(['status' => 'error', 'message' => __('otp.resend_error')]);
        }

    }

    // mail function
    public function sendotp_on_mail($email,$otp,$name,$lastname){

        $subject = "Your OTP for Verification";

        $full_name = $name .' '. $lastname;
        
        Mail::send('emails/otp',['otp' => $otp, 'full_name' => $full_name], function ($message) use ($subject,$email) {
            $message->to($email);
            $message->subject($subject);
        });
    }

}
