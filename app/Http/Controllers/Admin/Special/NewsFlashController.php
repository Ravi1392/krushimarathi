<?php

namespace App\Http\Controllers\Admin\Special;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SpecialCategory;
use App\Models\User;
use App\Models\NewsFlash;
use App\Models\NewsFlashData;
use App\Models\Blog;
use App\Traits\BlogSidebarTrait;
use Carbon\Carbon;
use DataTables;
use Auth;

class NewsFlashController extends Controller {

    use BlogSidebarTrait;

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Special.NewsFlash.index');
    }

    public function getLiveUpdateData() {
        
        $user = Auth::user();

        if($user->role_id === 2){
            $data = NewsFlash::select('id', 'language_id', 'slug', 'views', 'is_active', 'created_at', 'deleted_at')
            ->where('user_id', "=", $user->id)->withCount('newsflashsdata')->orderBy('id', 'desc')->withTrashed();
        }else{
            $data = NewsFlash::select('id', 'language_id', 'slug', 'views', 'is_active', 'created_at', 'deleted_at')->withCount('newsflashsdata')->orderBy('id', 'desc')->withTrashed();
        }

        return DataTables::of($data)
                        ->editColumn('language_id', function ($request) {
                            if($request->language_id == 1){
                                return "Marathi";
                            }elseif($request->language_id == 2){
                                return "Hindi";
                            }elseif($request->language_id == 3){
                                return "English";
                            }
                        })
                        ->addColumn('data_count', function ($data) {
                            return $data->newsflashsdata_count;
                        })
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
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
                                return '<a class="restore_row font-size-16" data-value = "' . route('admin.news_flash.newsFlashRestore', ['id' => $data->id]) . '" title = "Restore"><i class="icon-undo"></i></a>';
                            }else{
                                return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.news_flash.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                                <a class="delete_row font-size-16" data-value = "' . route('admin.news_flash.newsFlashDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>
                                <a class="font-size-16" target="_blank" href="' . route('admin.news_flash.newsFlashView', ['id' => base64_encode($data->id)]) . '"  title="View"><i class="icon-eye-plus"></i></a>
                                <a class="font-size-16"" href="' . route('admin.news_flash.flashData', ['id' => base64_encode($data->id)]) . '"  title="View"><i class="icon-plus-circle2"></i></a>';
                            }
                            
                        })
                        ->rawColumns(['active', 'action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        return view('Admin.Special.NewsFlash.add');
    }

    public function save(Request $request) {
        
        $user = Auth::user();
        if ($request->isMethod('post')) {
            
            $slug = Str::slug($request->slug);
            $news_flash = new NewsFlash();
            
            $news_flash->user_id = $user->id;
            $news_flash->slug = $slug;
            $news_flash->language_id = $request->language_id;
            $news_flash->content_updated_at = now();

            $news_flash->is_active = 0;
            $news_flash->save();
            
            if ($news_flash) {
                return redirect()->route('admin.news_flash.index')->with('success', 'News Flash is successfully save');
            } else {
                return redirect()->route('admin.news_flash.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.Special.NewsFlash.index');
        }
    }
    
    public function edit($id, Request $request) 
    {
        $id = base64_decode($id);
        $update = NewsFlash::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->language_id = $request->language_id;
            $update->slug = Str::slug($request->slug);
            $update->content_updated_at = now();

            $update->save();

            if ($update) {
                return redirect()->route('admin.news_flash.index')->with('success', 'News Flash is successfully updated');
            } else {
                return redirect()->route('admin.news_flash.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.Special.NewsFlash.edit',['update' => $update]);
    }

     public function view($id){
        
        $id = base64_decode($id);
        Carbon::setLocale('hi');

        $news_flash = NewsFlash::with([
            'user:id,name,last_name,username,profile',
            'newsflashsdata:id,news_flash_id,title,created_at',
        ])
        ->where('id', "=" ,$id)
        ->first();

        if(isset($news_flash) && !empty($news_flash)){

            return view('Admin.Special.NewsFlash.view',['id' => $id, 'news_flash' => $news_flash]);
        }else{
            return redirect()->route('admin.news_flash.index')->with('error', 'something went wrong.');
        }
    }

    public function newsFlashSlugCheck() {
        
        $news_flash_slug = Str::slug($_GET['slug']);

        $blogslug = NewsFlash::where(['slug' => $news_flash_slug])->count();

        if ($blogslug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function newsFlashSlugCheckUpdate($id) {
        
        $news_flash_slug = Str::slug($_GET['slug']);
        
        $slug = NewsFlash::where(['slug' => $news_flash_slug])->where('id', '!=', $id)->count();
        
        if ($slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function status($id, $status) {

        $news_flash_status = NewsFlash::where('id', $id)->update(array('is_active' => $status));

        if ($news_flash_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {

        $delete_news_flash = NewsFlash::where('id', $id)->delete();

        if ($delete_news_flash) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

    public function restore($id)
    {
        $record = NewsFlash::onlyTrashed()->find($id);

        if ($record) {
            $record->restore(); // Restore the deleted record
            return response()->json(['message' => 'News Flash Record restored successfully!']);
        }

        return response()->json(['message' => 'Record not found!'], 404);
    }
    
    public function resetViews() {

        $reset_views = NewsFlash::query()->update([
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

    public function flashData($id){

        return view('Admin.Special.NewsFlash.NewsFlashData.index', ['id' => $id]);
    }

    public function getnewsFlashDataList($id) {

        $id = base64_decode($id);
    
        $data = NewsFlashData::select('id','news_flash_id', 'title', 'created_at', 'deleted_at')
            ->where('news_flash_id', "=", $id)->orderBy('id', 'desc')->withTrashed();

        return DataTables::of($data)
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addColumn('action', function($data) {
                            if($data->deleted_at != NULL){
                                return '<a class="restore_row font-size-16" data-value = "' . route('admin.news_flash.flashDataRestore', ['id' => $data->id]) . '" title = "Restore"><i class="icon-undo"></i></a>';
                            }else{
                                return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.news_flash.editData', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                                <a class="delete_row font-size-16" data-value = "' . route('admin.news_flash.flashDataDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                            }
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function addData(Request $request, $id) {
        return view('Admin.Special.NewsFlash.NewsFlashData.add',['id' => $id]);
    }

    public function saveData(Request $request) {
        
        if ($request->isMethod('post')) {
            
            $news_flash_data = new NewsFlashData();
            
            $news_flash_data->news_flash_id = base64_decode($request->id);
            $news_flash_data->title = $request->title;
            $news_flash_data->save();
            
            if ($news_flash_data) {
                return redirect()->route('admin.news_flash.flashData', ['id' => $request->id])->with('success', 'News Flash Data is successfully save');
            } else {
                return redirect()->route('admin.news_flash.flashData', ['id' => $request->id])->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.Special.NewsFlash.index');
        }
    }

    public function editData($id, Request $request) 
    {
        $id = base64_decode($id);
        $update = NewsFlashData::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->title = $request->title;

            $update->save();

            if ($update) {
                return redirect()->route('admin.news_flash.flashData', ['id' => base64_encode($update->news_flash_id)])->with('success', 'News Flash is successfully updated');
            } else {
                return redirect()->route('admin.news_flash.flashData', ['id' => base64_encode($update->news_flash_id)])->with('error', 'something went wrong.');
            }
        }

        return view('Admin.Special.NewsFlash.NewsFlashData.edit',['update' => $update]);
    }

    public function deleteData($id) {

        $delete_news_flash = NewsFlashData::where('id', $id)->delete();

        if ($delete_news_flash) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

    public function restoreData($id)
    {
        $record = NewsFlashData::onlyTrashed()->find($id);

        if ($record) {
            $record->restore(); // Restore the deleted record
            return response()->json(['message' => 'News Flash Data Record restored successfully!']);
        }

        return response()->json(['message' => 'Record not found!'], 404);
    }

}
