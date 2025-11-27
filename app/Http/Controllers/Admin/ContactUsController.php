<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use DataTables;
use Validator;
use Auth;

class ContactUsController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.ContactUs.index');
    }
    public function getContactUsData(){
        
        $data = ContactUs::select('id','name','email','subject','created_at')->orderBy('id', 'desc');

        return DataTables::of($data)
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addColumn('action', function($data) {
                            return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.contactUs.view', ['id' => base64_encode($data->id)]) . '"  title="View"><i class="icon-eye-plus"></i></a>';
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function view($id) {
        
        $id = base64_decode($id);
        $update = ContactUs::select('id','comment')->where('id', $id)->first();

        return view('Admin/ContactUs/view',['update' => $update]);
    }

}
