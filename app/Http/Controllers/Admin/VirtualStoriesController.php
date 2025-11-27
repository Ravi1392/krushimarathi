<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Webstories;
use App\Models\WebstoriesData;
use Auth;
use DataTables;

class VirtualStoriesController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.VirtualStories.index');
    }

    public function getVirtualStoriesData() {
        $user = Auth::user();
        if($user->role_id === 2){
            $data = Webstories::select('id', 'title', 'slug', 'views','is_active','created_at')->where('user_id', "=", $user->id)->orderBy('id', 'desc');
        }else{
            $data = Webstories::select('id', 'title', 'slug', 'views','is_active','created_at')->orderBy('id', 'desc');
        }
        

        return DataTables::of($data)
                        ->addColumn('active', function ($data) {
                            $checked = ($data->is_active == 1) ? 'checked' : '';
                            return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch" data-size="sm" ' . $checked . '  />';
                        })
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addColumn('action', function($data) {
                            return '<a class="delete_row font-size-16" data-value = "' . route('admin.virtualStories.storyDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>';
                        })
                        ->rawColumns(['active', 'action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        return view('Admin/VirtualStories/add');
    }

    public function save(Request $request) {

        $user = Auth::user();
        if ($request->isMethod('post')) {

            $webstory = new Webstories();
            
            $webstory->user_id = $user->id;
            $webstory->title = $request->title;
            $webstory->slug = Str::slug($request->slug);
            $webstory->description = $request->description;
            $webstory->content_updated_at = now();

            if ($request->hasFile('story_image')) {
                $image = $request->file('story_image');
                $imagePath = public_path('/assets/visual_stories/images/');
                
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0775, true);
                }
                $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();

                $image->move($imagePath, $imageName);
                
                $webstory->story_image = $imageName;
            }

            $webstory->save();
            
            if ($webstory) {

                $year = date('Y');
                $month = date('m');
                $day = date('d');
        
                $imagePath = public_path("/assets/visual_stories/images/web_stories/{$year}/{$month}/{$day}/");

                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0775, true); // Create directory if not exists
                }

                if ($request->hasFile('story_image1')) {
                    $image = $request->file('story_image1');
                    // Generate unique image name
                    $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
    
                    // Move the image to the public folder
                    $image->move($imagePath, $imageName);    
                    // Store image data in the story_images table
                    WebstoriesData::create([
                        'visual_stories_id' => $webstory->id,
                        'value' => $request->image1,
                        'story_title' => $request->title1,
                        'story_description' => $request->story_description1,
                        'file_data' => $imageName,
                        'image_credit' => $request->image_credit1
                    ]);
                }

                if ($request->hasFile('story_image2')) {
                    $image = $request->file('story_image2');
                    // Generate unique image name
                    $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
    
                    // Move the image to the public folder
                    $image->move($imagePath, $imageName);    
                    // Store image data in the story_images table
                    WebstoriesData::create([
                        'visual_stories_id' => $webstory->id,
                        'value' => $request->image2,
                        'story_title' => $request->title2,
                        'story_description' => $request->story_description2,
                        'file_data' => $imageName,
                        'image_credit' => $request->image_credit2
                    ]);
                }

                if ($request->hasFile('story_image3')) {
                    $image = $request->file('story_image3');
                    // Generate unique image name
                    $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
    
                    // Move the image to the public folder
                    $image->move($imagePath, $imageName);    
                    // Store image data in the story_images table
                    WebstoriesData::create([
                        'visual_stories_id' => $webstory->id,
                        'value' => $request->image3,
                        'story_title' => $request->title3,
                        'story_description' => $request->story_description3,
                        'file_data' => $imageName,
                        'image_credit' => $request->image_credit3
                    ]);
                }

                if ($request->hasFile('story_video1')) {
                    $video = $request->file('story_video1');
                    // Generate unique image name
                    $imageName = md5(time() . '_' . $video->getClientOriginalName()) . '.' . $video->getClientOriginalExtension();
    
                    // Move the image to the public folder
                    $video->move($imagePath, $imageName);    
                    // Store image data in the story_images table
                    WebstoriesData::create([
                        'visual_stories_id' => $webstory->id,
                        'value' => $request->video1,
                        'story_title' => $request->video_title1,
                        'story_description' => $request->video_description1,
                        'file_data' => $imageName,
                        'image_credit' => $request->video_credit1
                    ]);
                }

                if ($request->hasFile('story_image4')) {
                    $image = $request->file('story_image4');
                    // Generate unique image name
                    $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
    
                    // Move the image to the public folder
                    $image->move($imagePath, $imageName);    
                    // Store image data in the story_images table
                    WebstoriesData::create([
                        'visual_stories_id' => $webstory->id,
                        'value' => $request->image4,
                        'story_title' => $request->title4,
                        'story_description' => $request->story_description4,
                        'file_data' => $imageName,
                        'image_credit' => $request->image_credit4
                    ]);
                }
                
                if ($request->hasFile('story_image5')) {
                    $image = $request->file('story_image5');
                    // Generate unique image name
                    $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
    
                    // Move the image to the public folder
                    $image->move($imagePath, $imageName);    
                    // Store image data in the story_images table
                    WebstoriesData::create([
                        'visual_stories_id' => $webstory->id,
                        'value' => $request->image5,
                        'story_title' => $request->title5,
                        'story_description' => $request->story_description5,
                        'file_data' => $imageName,
                        'image_credit' => $request->image_credit5
                    ]);
                }
                
                if ($request->hasFile('story_image6')) {
                    $image = $request->file('story_image6');
                    // Generate unique image name
                    $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
    
                    // Move the image to the public folder
                    $image->move($imagePath, $imageName);    
                    // Store image data in the story_images table
                    WebstoriesData::create([
                        'visual_stories_id' => $webstory->id,
                        'value' => $request->image6,
                        'story_title' => $request->title6,
                        'story_description' => $request->story_description6,
                        'file_data' => $imageName,
                        'image_credit' => $request->image_credit6
                    ]);
                }
                
                if ($request->hasFile('story_image7')) {
                    $image = $request->file('story_image7');
                    // Generate unique image name
                    $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
    
                    // Move the image to the public folder
                    $image->move($imagePath, $imageName);    
                    // Store image data in the story_images table
                    WebstoriesData::create([
                        'visual_stories_id' => $webstory->id,
                        'value' => $request->image7,
                        'story_title' => $request->title7,
                        'story_description' => $request->story_description7,
                        'file_data' => $imageName,
                        'image_credit' => $request->image_credit7
                    ]);
                }
                
                if ($request->hasFile('story_image8')) {
                    $image = $request->file('story_image8');
                    // Generate unique image name
                    $imageName = md5(time() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
    
                    // Move the image to the public folder
                    $image->move($imagePath, $imageName);    
                    // Store image data in the story_images table
                    WebstoriesData::create([
                        'visual_stories_id' => $webstory->id,
                        'value' => $request->image8,
                        'story_title' => $request->title8,
                        'story_description' => $request->story_description8,
                        'file_data' => $imageName,
                        'image_credit' => $request->image_credit8
                    ]);
                }

                return redirect()->route('admin.virtualStories.index')->with('success', 'Web Story is successfully save');
            } else {
                return redirect()->route('admin.virtualStories.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('admin.virtualStories.index');
        }

        //return view('Admin/ManageAdmin/add');
    }
    
    public function webStorySlugCheck() {
        
        $web_slug = Webstories::where(['slug' => $_GET['slug']])->count();
        if ($web_slug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function status($id, $status) {

        $web_status = Webstories::where('id', $id)->update(array('is_active' => $status));
        if ($web_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {
        $delete_webstory = Webstories::where('id', $id)->delete();

        if ($delete_webstory) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
    
    public function resetViews() {

        $reset_views = Webstories::query()->update(['views' => 0]);
        if ($reset_views) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
