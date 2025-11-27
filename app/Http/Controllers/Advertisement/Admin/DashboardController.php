<?php

namespace App\Http\Controllers\Advertisement\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Advertisement\Customer;
use Auth;
use Validator;

class DashboardController extends Controller {

    public function __construct() {
        
    }

    public function index() {

        $customer_data = Auth::guard('customer')->user();

        return view('advertisement.dashboard.index');
    }

}
