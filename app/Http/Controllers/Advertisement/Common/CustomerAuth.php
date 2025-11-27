<?php

namespace App\Http\Controllers\Advertisement\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Advertisement\Customer;
use Redirect;
use DB;
use Log;
use Mail;

class CustomerAuth extends Controller
{
    public function showLoginForm()
    {
        return view('advertisement.pages.login');
    }

    public function verifyPhoneNo() {

        $phone = Customer::where(['phone' => $_GET['phone']])->count();
        
        if ($phone != 0) {
            echo "true";
        } else {
            echo "false";
        }
        exit;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->intended('/ads/dashboard');
        }

        return redirect()->route('ads.loginForm')->with('error', '⚠️ Login failed. The details you entered do not match our records.');
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('ads'); 
    }

    public function showRegisterForm()
    {
        return view('advertisement.pages.registration');
    }

    public function saveCustomer(Request $request)
    {
        $otp = generateRandomPassword();

        if ($request->isMethod('post')) {

            $customer = new Customer();
            
            $customer->name = $request->name;
            $customer->last_name = $request->last_name;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->password = Hash::make($request->password);
            $customer->business_type_id = 14;
            $customer->is_active = 1;
            $customer->otp = $otp;
            $customer->save();
            
            if ($customer) {

                Auth::guard('customer')->login($customer);

                try {
                    $this->sendotp_on_mail($request->email, $otp, $request->name, $request->last_name);
                } catch (\Exception $e) { 
                    \Log::error('OTP email sending failed: ' . $e->getMessage(), [
                        'email' => $email,
                        'exception' => $e->getTraceAsString(), // Logs the full stack trace for detailed debugging
                        'code' => $e->getCode(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine()
                    ]);
                }

                return redirect()->route('ads.dashboard')->with('success', 'Thank you! Your details have been saved successfully.');
            } else {
                return redirect()->route('ads.register')->with('error', 'something went wrong.');
            }
        } else {
            return view('advertisement.pages.registration');
        }
    }

    public function phoneCheck() {

        $phone = Customer::where(['phone' => $_GET['phone']])->count();
        
        if ($phone != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function emailCheck() {

        $phone = Customer::where(['email' => $_GET['email']])->count();
        
        if ($phone != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
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
