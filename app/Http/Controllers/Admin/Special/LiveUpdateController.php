<?php

namespace App\Http\Controllers\Admin\Special;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SpecialCategory;
use App\Models\User;
use App\Models\LiveUpdate;
use App\Models\LiveUpdateData;
use App\Models\Blog;
use App\Traits\BlogSidebarTrait;
use Carbon\Carbon;
use DataTables;
use Auth;

class LiveUpdateController extends Controller {

    use BlogSidebarTrait;

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Special.LiveUpdate.index');
    }

    public function getLiveUpdateData() {
        
        $user = Auth::user();
        if($user->role_id === 2){
            $data = LiveUpdate::select('id','slug', 'views', 'is_active', 'created_at', 'deleted_at')
            ->where('user_id', "=", $user->id)->withCount('liveupdatesdata')->orderBy('id', 'desc')->withTrashed();
        }else{
            $data = LiveUpdate::select('id', 'slug', 'views', 'is_active', 'created_at', 'deleted_at')->withCount('liveupdatesdata')->orderBy('id', 'desc')->withTrashed();
        }
        
        return DataTables::of($data)
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addColumn('data_count', function ($data) {
                            return $data->liveupdatesdata_count;
                        })
                        ->addColumn('active', function ($data) {
                            if($data->deleted_at != NULL){
                                return '';
                            }else{
                                $checked = ($data->is_active == 1) ? 'checked' : '';
                                return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch" data-size="sm" ' . $checked . '  />';
                            }
                        })
                        ->addColumn('action', function($data) {
                            if($data->deleted_at != NULL){
                                return '<a class="restore_row font-size-16" data-value = "' . route('admin.live_update.liveUpdateRestore', ['id' => $data->id]) . '" title = "Restore"><i class="icon-undo"></i></a>';
                            }else{
                                return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.live_update.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                                <a class="delete_row font-size-16" data-value = "' . route('admin.live_update.liveUpdateDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>
                                <a class="font-size-16" target="_blank" href="' . route('admin.live_update.liveUpdateView', ['id' => base64_encode($data->id)]) . '"  title="View"><i class="icon-eye-plus"></i></a>
                                <a class="font-size-16"" href="' . route('admin.live_update.liveData', ['id' => base64_encode($data->id)]) . '"  title="View"><i class="icon-plus-circle2"></i></a>';
                            }
                            
                        })
                        ->rawColumns(['active', 'action', 'data_count'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        return view('Admin.Special.LiveUpdate.add');
    }

    public function save(Request $request) {
        
        $user = Auth::user();
        if ($request->isMethod('post')) {
            
            $slug = Str::slug($request->slug);
            $live_update = new LiveUpdate();
            
            $live_update->user_id = $user->id;
            $live_update->slug = $slug;
            $live_update->is_active = 0;
            $live_update->content_updated_at = now();
            
            $live_update->save();
            
            if ($live_update) {
                return redirect()->route('admin.live_update.index')->with('success', 'Live Update is successfully save');
            } else {
                return redirect()->route('admin.live_update.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.Special.LiveUpdate.index');
        }
    }
    
    public function edit($id, Request $request) 
    {
        $id = base64_decode($id);
        $update = LiveUpdate::where('id', $id)->first();

        if ($request->isMethod('post')) {

            
            $update->slug = Str::slug($request->slug);
            $update->content_updated_at = now();

            $update->save();

            if ($update) {
                return redirect()->route('admin.live_update.index')->with('success', 'Live Update is successfully updated');
            } else {
                return redirect()->route('admin.live_update.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.Special.LiveUpdate.edit',['update' => $update]);
    }

     public function view($id){
        
        $id = base64_decode($id);
        Carbon::setLocale('hi');

        $live_update = LiveUpdate::with([
            'user:id,name,last_name,username,profile',
            'liveupdatesdata:id,live_update_id,title,description,created_at',
        ])
        ->where('id', "=" ,$id)
        ->first();

        if(isset($live_update) && !empty($live_update)){

            return view('Admin.Special.LiveUpdate.view',['id' => $id, 'live_update' => $live_update]);
        }else{
            return redirect()->route('admin.live_update.index')->with('error', 'something went wrong.');
        }
    }

    public function liveUpdateSlugCheck() {
        
        $live_update_slug = Str::slug($_GET['slug']);

        $blogslug = LiveUpdate::where(['slug' => $live_update_slug])->count();

        if ($blogslug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function liveUpdateSlugCheckUpdate($id) {
        
        $live_update_slug = Str::slug($_GET['slug']);
        
        $slug = LiveUpdate::where(['slug' => $live_update_slug])->where('id', '!=', $id)->count();
        
        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function status($id, $status) {

        $live_update_status = LiveUpdate::where('id', $id)->update(array('is_active' => $status));

        if ($live_update_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {

        $delete_live_update = LiveUpdate::where('id', $id)->delete();

        if ($delete_live_update) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

    public function restore($id)
    {
        $record = LiveUpdate::onlyTrashed()->find($id);

        if ($record) {
            $record->restore(); // Restore the deleted record
            return response()->json(['message' => 'Live Update Record restored successfully!']);
        }

        return response()->json(['message' => 'Record not found!'], 404);
    }
    
    public function resetViews() {

        $reset_views = LiveUpdate::query()->update([
            'views' => DB::raw('GREATEST(0, views - 5)')
        ]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }

    // -----------------------------------------------------

    //Live Update Data

    public function liveData($id){

        return view('Admin.Special.LiveUpdate.LiveUpdateData.index', ['id' => $id]);
    }

    public function getLiveUpdateDataList($id) {

        $id = base64_decode($id);
    
        $data = LiveUpdateData::select('id','live_update_id', 'title', 'created_at', 'deleted_at')
            ->where('live_update_id', "=", $id)->orderBy('id', 'desc')->withTrashed();

        return DataTables::of($data)
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addColumn('action', function($data) {
                            if($data->deleted_at != NULL){
                                return '<a class="restore_row font-size-16" data-value = "' . route('admin.live_update.liveDataRestore', ['id' => $data->id]) . '" title = "Restore"><i class="icon-undo"></i></a>';
                            }else{
                                return '<a class="font-size-16" href="' . route('admin.live_update.editData', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                                <a class="delete_row font-size-16" data-value = "' . route('admin.live_update.liveDataDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                            }
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function addData(Request $request, $id) {
        return view('Admin.Special.LiveUpdate.LiveUpdateData.add',['id' => $id]);
    }

    public function saveData(Request $request) {
        
        if ($request->isMethod('post')) {
            
            $live_update_data = new LiveUpdateData();
            
            $live_update_data->live_update_id = base64_decode($request->id);
            $live_update_data->title = $request->title;
            $live_update_data->description = $request->description;
            $live_update_data->save();
            
            if ($live_update_data) {
                return redirect()->route('admin.live_update.liveData', ['id' => $request->id])->with('success', 'Live Update Data is successfully save');
            } else {
                return redirect()->route('admin.live_update.liveData', ['id' => $request->id])->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.Special.LiveUpdate.index');
        }
    }

    public function editData($id, Request $request) 
    {
        $id = base64_decode($id);
        $update = LiveUpdateData::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->title = $request->title;
            $update->description = $request->description;

            $update->save();

            if ($update) {
                return redirect()->route('admin.live_update.liveData', ['id' => base64_encode($update->live_update_id)])->with('success', 'Live Update is successfully updated');
            } else {
                return redirect()->route('admin.live_update.liveData', ['id' => base64_encode($update->live_update_id)])->with('error', 'something went wrong.');
            }
        }

        return view('Admin.Special.LiveUpdate.LiveUpdateData.edit',['update' => $update]);
    }

    public function deleteData($id) {

        $delete_live_update = LiveUpdateData::where('id', $id)->delete();

        if ($delete_live_update) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

    public function restoreData($id)
    {
        $record = LiveUpdateData::onlyTrashed()->find($id);

        if ($record) {
            $record->restore(); // Restore the deleted record
            return response()->json(['message' => 'Live Update Data Record restored successfully!']);
        }

        return response()->json(['message' => 'Record not found!'], 404);
    }

}
