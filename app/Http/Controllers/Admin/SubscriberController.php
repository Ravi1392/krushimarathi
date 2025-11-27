<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Subscriber;
use Auth;
use DataTables;

class SubscriberController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Subscriber.index');
    }

    public function getSubscribersData() {
        
        $data = Subscriber::orderBy('id', 'desc');
        
        return DataTables::of($data)
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addColumn('action', function($data) {
                            return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.subscriber.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                            
                            <a class="delete_row font-size-16" data-value = "' . route('admin.subscriber.subscriberDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        return view('Admin.Subscriber.add');
    }

    public function save(Request $request) {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->save();
            
            if ($subscriber) {
                return redirect()->route('admin.subscriber.index')->with('success', 'Subscriber is successfully save');
            } else {
                return redirect()->route('admin.subscriber.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.Subscriber.index');
        }
    }

    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = Subscriber::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->email = $request->email;
            $update->save();
            if ($update) {
                return redirect()->route('admin.subscriber.index')->with('success', 'Subscriber is successfully updated');
            } else {
                return redirect()->route('admin.subscriber.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.Subscriber.edit',['update' => $update]);
    }

    public function subscriberCheck() {

        $subscriber = Subscriber::where(['email' => $_GET['email']])->count();
        if ($subscriber != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function subscriberCheckUpdate($id) {
        
        $subscriber = Subscriber::where(['email' => $_GET['email']])->where('id', '!=', $id)->count();
        if ($subscriber != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function delete($id) {
        $delete_subscriber = Subscriber::where('id', $id)->delete();

        if ($delete_subscriber) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

}
