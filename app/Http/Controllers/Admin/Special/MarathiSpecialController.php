<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SpecialCategory;
use App\Models\User;
use App\Models\Blog;
use App\Traits\BlogSidebarTrait;
use DataTables;
use Auth;
use Intervention\Image\Facades\Image as ImageEditor;

class MarathiSpecialController extends Controller {

    use BlogSidebarTrait;

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Blog.index');
    }

    public function getBlogData() {
        
        $user = Auth::user();
        if($user->role_id === 2){
            $data = SpecialCategory::with(['category:id,name','subcategory:id,name'])
            ->select('id', 'category_id', 'sub_category_id','blog_title', 'views','is_active', 'created_at')
            ->where('user_id', "=", $user->id)
            ->orderBy('id', 'desc');
        }else{
            $data = SpecialCategory::with(['category:id,name','subcategory:id,name'])
            ->select('id', 'category_id', 'sub_category_id','blog_title', 'views','is_active', 'created_at')
            ->orderBy('id', 'desc');
        }

        return DataTables::of($data)
                        ->addColumn('category_name', function ($data) {
                            return !empty($data->category->name) ? $data->category->name : '';
                        })
                        ->addColumn('sub_category_name', function ($data) {
                            return !empty($data->subcategory->name) ? $data->subcategory->name : '';
                        })
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addColumn('active', function ($data) {
                            $checked = ($data->is_active == 1) ? 'checked' : '';
                            return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch" data-size="sm" ' . $checked . '  />';
                        })
                        ->addColumn('action', function($data) {
                            return '<a class="font-size-16" href="' . route('admin.blog.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('admin.blog.blogDelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash"></i></a>
                                <a class="font-size-16" target="_blank" href="' . route('admin.blog.view', ['id' => base64_encode($data->id)]) . '"  title="View"><i class="icon-eye-plus"></i></a>';
                        })
                        ->rawColumns(['category_name', 'sub_category_name', 'active', 'action'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function add(Request $request) {
        // $categories  = Category::where('is_active',1)->select('id', 'name', 'is_active')->get();
        $categories  = Category::select('id', 'name', 'is_active')->where('is_active',1)->get();
        $blogs  = Blog::where('is_active',1)->select('id', 'blog_title', 'is_active')->orderBy('id', 'desc')->get();
                
        return view('Admin.Blog.add',['categories'=> $categories, 'blogs' => $blogs]);
    }

    public function save(Request $request) {
        
        $user = Auth::user();
        if ($request->isMethod('post')) {
            
            $slug = Str::slug($request->blog_slug);
            $blog = new MarathiSpecial();
            
            $blog->user_id = $user->id;
            $blog->category_id = $request->category_id;
            $blog->sub_category_id = $request->sub_category_id;
            $blog->blog_title = $request->blog_title;
            $blog->blog_slug = $slug;
            
            if ($request->hasFile('blog_image')) {
                $image = $request->file('blog_image');
                $imagePath = public_path('/assets/admin/images/blog_image/');
                
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0775, true);
                }
                $blogImageName = $slug . '.webp';
                
                $webpImagePath = $imagePath . $blogImageName;
                $this->convertToWebP($image->getPathname(), $webpImagePath);
                
                $blog->blog_image = $blogImageName;
            }
            
            $blog->short_description = $request->short_description;
            $blog->meta_keyword = $request->meta_keyword;
            $blog->meta_description = $request->meta_description;
            $blog->related_blog_id = $request->related_blog_id;

            //First Info
            $blog->first_title	 = $request->first_title;
            $blog->first_description = $request->first_description;

            //Second Info
            $blog->second_title = $request->second_title;
            $blog->second_description = $request->second_description;
            $blog->is_active = 1;
            $blog->save();
            
            if ($blog) {
                //multiple image logic
                $year = date('Y');    // e.g., 2024
                $month = date('m');   // e.g., 09
                $day = date('d');
        
                $imageNewPath = public_path("/assets/admin/images/blog_image/{$year}/{$month}/{$day}/");
            
                // Create the directory if it doesn't exist
                if (!file_exists($imageNewPath)) {
                    mkdir($imageNewPath, 0775, true);
                }
        
                // Define sizes for different crops
                $imageFullPath = $imagePath . $blogImageName;
                //dd($imageFullPath);
                $sizes = [
                    ['width' => 3264, 'height' => 1825],
                    ['width' => 2560, 'height' => 1430],
                    ['width' => 2048, 'height' => 1145],
                    ['width' => 1536, 'height' => 858],
                    ['width' => 1024, 'height' => 572],
                    ['width' => 768, 'height' => 429],
                    ['width' => 300, 'height' => 168]
                ];

                foreach ($sizes as $size) {
                    // Generate the save path for the cropped image
                    $originalName = $image->getClientOriginalName();
                    $croppedFileName = "{$slug}_{$size['width']}_{$size['height']}.webp";
                    $savePath = $imageNewPath . $croppedFileName;
            
                    // Call the cropImage function with the desired dimensions
                    $this->cropImage($imageFullPath, $size['width'], $size['height'], $savePath);
            
                    // Store the cropped image info into the database
                    BlogImage::create([
                        'blog_id' => $blog->id,
                        'original_image' => $blogImageName,
                        'cropped_image'  => $croppedFileName,
                        'width'          => $size['width'],
                        'height'         => $size['height'],
                    ]);
                }

                return redirect()->route('admin.blog.index')->with('success', 'Blog is successfully save');
            } else {
                return redirect()->route('admin.blog.index')->with('error', 'something went wrong.');
            }
        } else {
            return view('Admin.blog.index');
        }
    }
    
    public function edit($id, Request $request) 
    {
        
        $id = base64_decode($id);
        $update = Blog::where('id', $id)->first();
        $blogs  = Blog::select('id', 'blog_title', 'is_active')->where('is_active',1)->where('id', '!=', $id)->orderBy('id', 'desc')->get();

        if ($request->isMethod('post')) {

            $update->blog_title = $request->blog_title;
            $update->blog_slug = Str::slug($request->blog_slug);
            $update->short_description = $request->short_description;
            $update->meta_keyword = $request->meta_keyword;
            $update->meta_description = $request->meta_description;
            $update->related_blog_id = $request->related_blog_id;
            
            $update->first_title = $request->first_title;
            $update->first_description = $request->first_description;
            $update->second_title = $request->second_title;
            $update->second_description = $request->second_description;
            $update->second_related_blog = $request->second_related_blog;

            $update->save();

            if ($update) {
                return redirect()->route('admin.blog.index')->with('success', 'Blog is successfully updated');
            } else {
                return redirect()->route('admin.blog.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin.Blog.edit',['update' => $update, 'blogs' => $blogs]);
    }

    public function blogCheck(Request $request) {
       
        $blog = Blog::where('blog_title', $_GET['blog_title'])
                ->where('category_id', $_GET['category_id'])
                ->count();

        if ($blog != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function blogSlugCheck() {
        $blog_slug = Str::slug($_GET['blog_slug']);
        $blogslug = Blog::where(['blog_slug' => $blog_slug])->count();

        if ($blogslug != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    //It is for Multiple images
    private function cropImage($imagePath, $width, $height, $savePath)
    {
        // Load and crop the image
        $img = ImageEditor::make($imagePath)
                ->fit($width, $height)
                ->encode('webp', 100);
        
        // Save the cropped image
        $img->save($savePath);
    }

    // Function to convert the image to WebP format
    private function convertToWebP($imageFullPath, $savePath)
    {
        //image and convert it to WebP format
        $image = ImageEditor::make($imageFullPath)
            ->fit(1200, 700)
            ->encode('webp', 100);   // Convert the image to .webp with 80% quality

        // Save the WebP image to the specified path
        $image->save($savePath);
    }

    public function status($id, $status) {

        $blog_status = Blog::where('id', $id)->update(array('is_active' => $status));
        if ($blog_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete($id) {
        $delete_blog = Blog::where('id', $id)->delete();

        if ($delete_blog) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
    
    public function blogView($id){
        $id = base64_decode($id);
        $blog = Blog::with([
            'user:id,name,last_name'
        ])
        ->where('id', "=" ,$id)
        ->where('is_active', "=", 1)
        ->first();

        if(isset($blog) && !empty($blog)){

            $sidebar_blogs = $this->getSidebarBlogs($blog->category->category_slug,$id);

            return view('Admin.Blog.view',['category_slug' => $blog->category->category_slug, 'subcategory_slug' => $blog->category->subcategory_slug, 'id' => $id, 'blog' => $blog, 'sidebar_blogs' => $sidebar_blogs]);
        }else{
            return redirect()->route('admin.blog.index')->with('error', 'something went wrong.');
        }
    }

}
