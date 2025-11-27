<?php

namespace App\Http\Controllers\Advertisement\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Advertisement\Category;
use App\Models\Advertisement\Unit;
use App\Models\Advertisement\BusinessType;
use App\Models\Advertisement\Customer;
use App\Models\Advertisement\Product;
use App\Models\State;
use Mail;
use Intervention\Image\Facades\Image as ImageEditor;

class ProductController extends Controller
{

    public function AdvertisementForm()
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

        return view('advertisement.product_pages.product_form',['locale' => $locale,'states' => $states, 'categories' => $categories, 'units' => $units, 'business_types' => $business_types]);
    }

    public function saveProduct(Request $request)
    {
        $locale = session('locale', 'en');

        if ($request->isMethod('post')) {

            $customer = new Customer();
            
            $customer->name = $request->name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->state_id = $request->state_id;
            $customer->district_id = $request->district_id;
            $customer->business_type_id = $request->business_type_id;
            $customer->status = 'Pending';
            $customer->is_active = 1;
            
            if ($customer->save()) {

                Auth::guard('customer')->login($customer);

                $customer_id = Auth::guard('customer')->id();

                if (Auth::guard('customer')->check()) {

                    $product = new Product();

                    $product->customer_id = $customer_id;
                    $product->lead_type = $request->lead_type;
                    $product->language_code = $locale;
                    $product->category_id = $request->category_id;
                    $product->sub_category_id = $request->sub_category_id;
                    $product->variety = $request->variety ?? 'Normal';
                    $product->quantity = $request->quantity;
                    $product->unit_id = $request->unit_id;
                    $product->price = $request->price;
                    $product->is_organic = $request->is_organic;
                    $product->selling = $request->selling_frequency;
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

                    $product->is_active = 0;
                    $product->status = "Pending";

                    if ($product->save()) {
                        return redirect()->route('ads.profile')->with('success', 'Thank you! Your ad has been posted successfully. Please verify your account and complete your profile to attract more buyers.');
                    }else{
                        return redirect()->route('ads.post-advertisement')->with('error', 'Something went wrong while saving your product. Please try again.');
                    }
                    
                }else{
                    return redirect()->back()->with('error', 'We could not log you in. Please try again.');
                }
            } else {
                return redirect()->route('ads.post-advertisement')->with('error', 'Failed to register. Please check your details and try again.');
            }
        } else {
            return view('advertisement.product_pages.product_form');
        }
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
