<?php

namespace App\Http\Controllers\Advertisement\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Advertisement\Category;
use App\Models\Advertisement\Unit;
use App\Models\Advertisement\BusinessType;
use App\Models\Advertisement\Customer;
use App\Models\Advertisement\Product;
use App\Models\Advertisement\Requirement;
use App\Models\State;
use Mail;
use DataTables;
use Intervention\Image\Facades\Image as ImageEditor;
use App\Traits\HasFilteredCategories;
use App\Traits\WishlistTrait;

class ManageProductController extends Controller
{
    use HasFilteredCategories, WishlistTrait;

    public function sellProductList()
    {
        return view('advertisement.dashboard.product.saleProducts');
    }

    public function getSellProductData()
    {
        $customer = Auth::guard('customer')->user();

        $data = Product::with('category:id,en_name,hi_name,mr_name')
                ->leftJoin('ads_categories', 'ads_products.category_id', '=', 'ads_categories.id')
                ->leftJoin('ads_sub_categories', 'ads_products.sub_category_id', '=', 'ads_sub_categories.id')
                ->select(
                    'ads_products.id as id',
                    'ads_products.category_id',
                    'ads_products.sub_category_id',
                    'ads_products.title',
                    'ads_products.price',
                    'ads_products.is_active',
                    'ads_products.status as status',
                    'ads_categories.id as ads_category_id',
                    'ads_categories.en_name as category_name',
                    'ads_sub_categories.en_name as sub_category_name'
                )->where('customer_id','=', $customer->id)
                ->where('lead_type','=', 0);

        return DataTables::of($data)
                        ->editColumn('category_name', function ($data) {
                            return $data->category_name ?? '';
                        })
                        ->filterColumn('category_name', function ($query, $keyword) {
                            $query->where('ads_categories.en_name', 'like', "%{$keyword}%");
                        })
                        ->editColumn('sub_category_name', function ($data) {
                            return $data->sub_category_name ?? '';
                        })
                        ->filterColumn('sub_category_name', function ($query, $keyword) {
                            $query->where('ads_sub_categories.en_name', 'like', "%{$keyword}%");
                        })
                        ->addColumn('active', function ($data) {
                                $checked = ($data->is_active == 1) ? 'checked' : '';
                                return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch form-check-input-switchery-primary" data-switchery="true" data-size="sm" ' . $checked . '  />';
                           
                        })
                        ->addColumn('action', function($data) {
                                return '<a class="font-size-16" href="' . route('ads.editAdsProduct', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7 mr-1"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('ads.productdelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash mr-1"></i></a>
                                
                                <a class="font-size-16" href="' . route('ads.view', ['id' => base64_encode($data->id)]) . '"  title="View"><i class="icon-eye-plus"></i></a>';
                           
                        })
                        ->addColumn('status', function ($data) {
                            if($data->status == "Approved"){
                                return '<span class="badge badge-success">Approved</span>';
                            }else if($data->status == "Rejected"){
                                return '<span class="badge badge-danger">Rejected</span>';
                            }else{
                                return '<span class="badge badge-info">Pending</span>';
                            }
                        })
                        ->rawColumns(['active', 'action', 'status'])
                        ->addIndexColumn()
                        ->toJson();
    }
    
    public function buyProductList()
    {
        return view('advertisement.dashboard.product.buyProducts');
    }

    public function getBuyProductData()
    {
        $customer = Auth::guard('customer')->user();

        $data = Product::with('category:id,en_name,hi_name,mr_name')
                ->leftJoin('ads_categories', 'ads_products.category_id', '=', 'ads_categories.id')
                ->leftJoin('ads_sub_categories', 'ads_products.sub_category_id', '=', 'ads_sub_categories.id')
                ->select(
                    'ads_products.id as id',
                    'ads_products.category_id',
                    'ads_products.sub_category_id',
                    'ads_products.title',
                    'ads_products.price',
                    'ads_products.is_active',
                    'ads_products.status as status',
                    'ads_categories.id as ads_category_id',
                    'ads_categories.en_name as category_name',
                    'ads_sub_categories.en_name as sub_category_name'
                )->where('customer_id','=', $customer->id)
                ->where('lead_type','=', 1);

        return DataTables::of($data)
                        ->editColumn('category_name', function ($data) {
                            return $data->category_name ?? '';
                        })
                        ->filterColumn('category_name', function ($query, $keyword) {
                            $query->where('ads_categories.en_name', 'like', "%{$keyword}%");
                        })
                        ->editColumn('sub_category_name', function ($data) {
                            return $data->sub_category_name ?? '';
                        })
                        ->filterColumn('sub_category_name', function ($query, $keyword) {
                            $query->where('ads_sub_categories.en_name', 'like', "%{$keyword}%");
                        })
                        ->addColumn('active', function ($data) {
                                $checked = ($data->is_active == 1) ? 'checked' : '';
                                return '<input type="checkbox" id="switcherySize2"  data-value="' . $data->id . '"  class="switchery switch form-check-input-switchery-primary" data-switchery="true" data-size="sm" ' . $checked . '  />';
                           
                        })
                        ->addColumn('action', function($data) {
                                return '<a class="font-size-16" href="' . route('ads.editAdsProduct', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7 mr-1"></i></a>
                               
                                <a class="delete_row font-size-16" data-value = "' . route('ads.productdelete', ['id' => $data->id]) . '" title = "Delete"><i class="icon-trash mr-1"></i></a>
                                
                                <a class="font-size-16" href="' . route('ads.view', ['id' => base64_encode($data->id)]) . '"  title="View"><i class="icon-eye-plus"></i></a>';
                           
                        })
                        ->addColumn('status', function ($data) {
                            if($data->status == "Approved"){
                                return '<span class="badge badge-success">Approved</span>';
                            }else if($data->status == "Rejected"){
                                return '<span class="badge badge-danger">Rejected</span>';
                            }else{
                                return '<span class="badge badge-info">Pending</span>';
                            }
                        })
                        ->rawColumns(['active', 'action', 'status'])
                        ->addIndexColumn()
                        ->toJson();
    }

    public function postRequirement()
    {
        $locale = session('locale', 'en');

        $orderColumn = match($locale) {
            'mr' => 'mr_name',
            'hi' => 'hi_name',
            default => 'en_name',
        };

        $states = State::active()->select('id','en_name','mr_name')->orderBy('en_name', 'asc')->get()->map(function ($state) use ($locale) {
            $name = match($locale) {
                'mr' => $state->mr_name ?: $state->en_name,
                'hi' => $state->mr_name ?: $state->en_name,
                default => $state->en_name,
            };
            $state->name = $name;
            return $state;
        });

        $categories = Category::active()
            ->select('id','en_name','hi_name','mr_name')
            ->orderBy($orderColumn, 'asc')
            ->get()
            ->map(function ($category) use ($locale) {
                $name = match($locale) {
                    'mr' => $category->mr_name ?: $category->en_name,
                    'hi' => $category->hi_name ?: $category->en_name,
                    default => $category->en_name,
                };
                $category->name = $name;
                return $category;
            });

        $units = Unit::select('id','en_name','hi_name','mr_name')
            ->orderBy($orderColumn, 'asc')
            ->get()
            ->map(function ($unit) use ($locale) {
                $name = match($locale) {
                    'mr' => $unit->mr_name ?: $unit->en_name,
                    'hi' => $unit->hi_name ?: $unit->en_name,
                    default => $unit->en_name,
                };
                $unit->name = $name;
                return $unit;
            });

        $business_types = BusinessType::select('id','en_name','hi_name','mr_name')
            ->orderBy($orderColumn, 'asc')
            ->get()
            ->map(function ($business_type) use ($locale) {
                $name = match($locale) {
                    'mr' => $business_type->mr_name ?: $business_type->en_name,
                    'hi' => $business_type->hi_name ?: $business_type->en_name,
                    default => $business_type->en_name,
                };
                $business_type->name = $name;
                return $business_type;
            });

        return view('advertisement.dashboard.product.addProduct',['locale' => $locale,'states' => $states, 'categories' => $categories, 'units' => $units, 'business_types' => $business_types]);
    }

    public function saveAdsProduct(Request $request)
    {
        $locale = session('locale', 'en');
        $customer_id = Auth::guard('customer')->id();

        if ($request->isMethod('post')) {

            $product = new Product();

            $product->customer_id = $customer_id;
            $product->lead_type = $request->lead_type;
            $product->language_code = $locale;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->title = $request->title;
            $product->variety = $request->variety ?? 'Normal';
            $product->quantity = $request->quantity;
            $product->unit_id = $request->unit_id;
            $product->price = $request->price;
            $product->is_organic = $request->is_organic;
            $product->selling = $request->selling_frequency;
            
            if($request->address_link === 2){
                $product->address_link = $request->address_link;
            }else{
                $product->address_link = $request->address_link;
                $product->address = $request->address;
                $product->state_id = $request->state_id;
                $product->district_id = $request->district_id;
            }

            $product->product_description = $request->description;
            // \Log::info('Start');
            if ($request->hasFile('uploaded_files')) {
                // \Log::info('Process');
                $image = $request->file('uploaded_files');
                $imagePath = public_path('/assets/advertisement/images/product/');
                
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0775, true);
                }

                $date = now()->format('YmdHis');
                $imageName = 'product_' . $customer_id . '_' . $date . '.webp';
                
                $webpImagePath = $imagePath . $imageName;
                $this->convertToWebP($image->getPathname(), $webpImagePath);
                
                $product->photo = $imageName;
                // \Log::info('Done');
            }

            // \Log::info('End');

            $product->is_active = 1;
            $product->status = "Pending";

            if ($product->save()) {
                return redirect()->route('ads.sellProductList')->with('success', 'Thank you! Your advertisement has been posted successfully. It is currently pending admin approval. Please wait.');   
            }else{
                return redirect()->route('ads.post-requirement')->with('error', 'Something went wrong while saving your product. Please try again.');
            }
        } else {
            return view('advertisement.dashboard.product.addProduct');
        }
    }

    public function status($id, $status)
    {

        $product_status = Product::where('id', $id)->update(array('is_active' => $status));
        
        if ($product_status) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function edit($id, Request $request)
    {

        $locale = session('locale', 'en');

        $orderColumn = match($locale) {
            'mr' => 'mr_name',
            'hi' => 'hi_name',
            default => 'en_name',
        };

        $districtColumn = getLocalizedColumn('districts', $locale);

        $id = base64_decode($id);
        $update = Product::with([
                "subcategory:id,{$locale}_name as name,slug",
                "district:id,{$districtColumn} as name",
            ])->where('id', $id)->first();

        $states = State::active()->select('id','en_name','mr_name')->orderBy('en_name', 'asc')->get()->map(function ($state) use ($locale) {
            $name = match($locale) {
                'mr' => $state->mr_name ?: $state->en_name,
                'hi' => $state->mr_name ?: $state->en_name,
                default => $state->en_name,
            };
            $state->name = $name;
            return $state;
        });

        $categories = Category::active()
            ->select('id','en_name','hi_name','mr_name')
            ->orderBy($orderColumn, 'asc')
            ->get()
            ->map(function ($category) use ($locale) {
                $name = match($locale) {
                    'mr' => $category->mr_name ?: $category->en_name,
                    'hi' => $category->hi_name ?: $category->en_name,
                    default => $category->en_name,
                };
                $category->name = $name;
                return $category;
            });

        $units = Unit::select('id','en_name','hi_name','mr_name')
            ->orderBy($orderColumn, 'asc')
            ->get()
            ->map(function ($unit) use ($locale) {
                $name = match($locale) {
                    'mr' => $unit->mr_name ?: $unit->en_name,
                    'hi' => $unit->hi_name ?: $unit->en_name,
                    default => $unit->en_name,
                };
                $unit->name = $name;
                return $unit;
            });

        $business_types = BusinessType::select('id','en_name','hi_name','mr_name')
            ->orderBy($orderColumn, 'asc')
            ->get()
            ->map(function ($business_type) use ($locale) {
                $name = match($locale) {
                    'mr' => $business_type->mr_name ?: $business_type->en_name,
                    'hi' => $business_type->hi_name ?: $business_type->en_name,
                    default => $business_type->en_name,
                };
                $business_type->name = $name;
                return $business_type;
            });
        
        if ($request->isMethod('post')) {

            // $update->name = $request->name;
            $update->category_id = $request->category_id;
            $update->lead_type = $request->lead_type;
            $update->title = $request->title;
            $update->sub_category_id = $request->sub_category_id;
            $update->variety = $request->variety ?? 'Normal';
            $update->quantity = $request->quantity;
            $update->unit_id = $request->unit_id;
            $update->price = $request->price;
            $update->is_organic = $request->is_organic;
            $update->selling = $request->selling_frequency;
            
            if($request->address_link === 2){
                $update->address_link = $request->address_link;
            }else{
                $update->address_link = $request->address_link;
                $update->address = $request->address;
                $update->state_id = $request->state_id;
                $update->district_id = $request->district_id;
            }

            $update->product_description = $request->description;
            
            if ($request->hasFile('uploaded_files')) {
                
                $image = $request->file('uploaded_files');
                $imagePath = public_path('/assets/advertisement/images/product/');
                
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0775, true);
                }

                $date = now()->format('YmdHis');
                $imageName = 'product_' . $customer_id . '_' . $date . '.webp';
                
                $webpImagePath = $imagePath . $imageName;
                $this->convertToWebP($image->getPathname(), $webpImagePath);
                
                $update->photo = $imageName;

                // old image remove code
                $oldImagePath = $imagePath. $update->photo;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            if ($update->save()) {
                return redirect()->route('ads.sellProductList')->with('success', 'Thank you! Your advertisement has been updated successfully.');   
            }else{
                return redirect()->route('ads.sellProductList')->with('error', 'Something went wrong while updating your product. Please try again.');
            }
        }

        return view('advertisement.dashboard.product.editProduct',['update' => $update,'locale' => $locale,'states' => $states, 'categories' => $categories, 'units' => $units, 'business_types' => $business_types]);
    }

    public function delete($id)
    {
        
        $delete_product = Product::where('id', $id)->delete();

        if ($delete_product) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
    
    public function view($id)
    {
        $id = base64_decode($id);
        $lang = session('locale', 'en');

        $stateColumn = getLocalizedColumn('states', $lang);
        $districtColumn = getLocalizedColumn('districts', $lang);
        $talukaColumn = getLocalizedColumn('talukas', $lang);
        $villageColumn = getLocalizedColumn('villages', $lang);

        $product_data = Product::withCount(['wishlists'])
            ->with([
                "category:id,{$lang}_name as name,slug",
                "subcategory:id,{$lang}_name as name,slug",
                "unit:id,{$lang}_name as name",
                "state:id,{$stateColumn} as name",
                "district:id,{$districtColumn} as name",
                "comments" => function ($q){
                    $q->select('id', 'customer_id', 'product_id', 'name', 'comment', 'is_active', 'created_at')
                    ->orderBy('created_at', 'desc');
                },
                'customer' => function ($q) use ($stateColumn, $districtColumn, $talukaColumn, $villageColumn, $lang) {
                    $q->select('id', 'name', 'last_name', 'middle_name', 'address', 'state_id', 'district_id', 'division_id', 'village_id', 'business_type_id', 'pincode', 'profile')
                        ->with([
                            "state:id,{$stateColumn} as name",
                            "district:id,{$districtColumn} as name",
                            "business_type:id,{$lang}_name as name",
                            "taluka:id,{$talukaColumn} as name",
                            "village:id,{$villageColumn} as name",
                        ]);
                }
            ])->where('id','=',$id)->first();

            $filtered_categories = $this->getFilteredCategories($lang);

        return view('advertisement.dashboard.product.view',['product' => $product_data, 'filtered_categories' => $filtered_categories,]);
    }
    
    public function quotesList()
    {
        return view('advertisement.dashboard.quotes');
    }

    public function quotesData()
    {
        $customer = Auth::guard('customer')->user();

        $data = Requirement::where('is_active','=', 1)->orderBy('id','desc');

        return DataTables::of($data)
                        ->editColumn('created_at', function ($request) {
                            return $request->created_at->format('d-m-Y');
                        })
                        ->addIndexColumn()
                        ->toJson();
    }

    // Function to convert the image to WebP format
    private function convertToWebP($imageFullPath, $savePath)
    {
        try {
            $image = ImageEditor::make($imageFullPath)
                ->fit(400, 225)
                ->encode('webp', 100);

            $image->save($savePath);
        } catch (\Exception $e) {
            \Log::info('WebP conversion failed: ' . $e->getMessage());
        }
    }

}
