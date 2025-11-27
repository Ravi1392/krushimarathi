<?php

namespace App\Http\Controllers\Advertisement\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\District;
use App\Models\Taluka;
use App\Models\Village;
use App\Models\Advertisement\Category;
use App\Models\Advertisement\SubCategory;
use App\Models\Advertisement\Requirement;
use App\Models\Advertisement\Customer;
use App\Traits\WishlistTrait;
use Mail;

class CommonController extends Controller
{
    use WishlistTrait;

    public function getDistricts($state_id)
    {

        $locale = session('locale', 'en');
        
        return District::active()->select('id','en_name','mr_name')->where('state_id', $state_id)->orderBy('en_name', 'asc')->get()->map(function ($district) use ($locale) {
            $name = match($locale) {
                'mr' => $district->mr_name ?: $district->en_name,
                'hi' => $district->mr_name ?: $district->en_name,
                default => $district->en_name,
            };
            $district->name = $name;
            return $district;
        });

    }

    public function getTalukas($district_id)
    {
        return Taluka::active()->select('id','en_name','mr_name')
        ->where('district_id', $district_id)
        ->orderBy('en_name', 'asc')
        ->get();
    }

    public function getVillages($taluka_id)
    {
        return Village::active()->select('id','en_name','mr_name')
        ->where('taluka_id', $taluka_id)
        ->orderBy('en_name', 'asc')
        ->get();
    }

    public function getSubCategories($category_id){

        $locale = session('locale', 'en');

        $orderColumn = match($locale) {
            'mr' => 'mr_name',
            'hi' => 'hi_name',
            default => 'en_name',
        };
        
        return SubCategory::active()
            ->select('id','en_name','hi_name','mr_name')
            ->where('ads_category_id', $category_id)
            ->orderBy($orderColumn, 'asc')
            ->get()
            ->map(function ($sub_category) use ($locale) {
                $name = match($locale) {
                    'mr' => $sub_category->mr_name ?: $sub_category->en_name,
                    'hi' => $sub_category->hi_name ?: $sub_category->en_name,
                    default => $sub_category->en_name,
                };
                $sub_category->name = $name;
                return $sub_category;
            });
    }

    public function addRequirement(Request $request)
    {

        $requirement = new Requirement();

        $requirement->name = $request->name;
        $requirement->phone = $request->phone;
        $requirement->requirement = $request->requirement;
        
        if ($requirement->save()) {
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'error']);
        }
    }

    public function customerProfile($customer_id)
    {
        $customer_id = base64_decode($customer_id);
        
        $lang = session('locale', 'en');

        $stateColumn = getLocalizedColumn('states', $lang);
        $districtColumn = getLocalizedColumn('districts', $lang);
        $talukaColumn = getLocalizedColumn('talukas', $lang);
        $villageColumn = getLocalizedColumn('villages', $lang);

        $customer_profile = Customer::select('id', 'name', 'last_name', 'middle_name', 'phone', 'gender', 'address', 'state_id', 'district_id', 'division_id', 'village_id', 'business_type_id', 'pincode', 'status', 'profile', 'profile_desc', 'business_name', 'created_at')
                ->with([
                    "state:id,{$stateColumn} as name",
                    "district:id,{$districtColumn} as name",
                    "business_type:id,{$lang}_name as name",
                    "taluka:id,{$districtColumn} as name",
                    "village:id,{$districtColumn} as name"
                ])->where('id', '=', $customer_id)->first();

        if($customer_profile){

            $ads_categories = Category::active()
                ->select("id", "{$lang}_name as name", "slug")
                ->get();

            $ads_categories = $ads_categories->map(function ($ads_category) use ($lang, $stateColumn, $districtColumn, $customer_id) {
                $products = $ads_category->products()->active()
                    ->where('customer_id',"=",$customer_id)
                    ->orderBy('id', 'desc')
                    ->limit(4)
                    ->with([
                        "subcategory:id,{$lang}_name as name,slug",
                        "unit:id,{$lang}_name as name",
                        "state:id,{$stateColumn} as name",
                        "district:id,{$districtColumn} as name",
                        // Old Address (via customer)
                        'customer' => function ($q) use ($stateColumn, $districtColumn) {
                            $q->select('id', 'name', 'last_name', 'state_id', 'district_id')
                            ->with([
                                'state:id,' . $stateColumn . ' as name',
                                'district:id,' . $districtColumn . ' as name',
                            ]);
                        }
                    ])
                    ->get();

                $ads_category->setRelation('products', $products);
                return $ads_category;
            })->filter(function ($ads_category) {
                return $ads_category->products->isNotEmpty();
            })->values();

            $wishlistProductIds = $this->getCustomerWishlistProductIds();

            return view('advertisement.pages.customer_profile',[
                'customer_profile' => $customer_profile,
                'ads_categories' => $ads_categories,
                'wishlistProductIds' => $wishlistProductIds
            ]);
        }else{
            return redirect()->back();
        }
    }

    public function SendTestEmail(){
        Mail::send([], [], function ($message) {
            //$message->to('sandhi.faiz@gmail.com');
            $message->to('patilravi1393@gmail.com');
            $message->subject('Equipments availability report');
            $message->setBody('Attached is the report for station: ', 'text/html');

        });
    }

    public function getBlogs(){
        
        $categories = Category::active()->select('id','name')->get();

        $categories = $categories->map(function ($category) {
            $blogs = $category->blogs()
                ->select('id', 'category_id', 'blog_title')
                ->orderBy('id', 'desc')
                ->limit(4)
                ->get();

            $category->setRelation('blogs', $blogs);
            return $category;
        })->filter(function ($category) {
            return $category->blogs->isNotEmpty();
        })->values();

        echo "<pre>";
        print_r($categories->toArray());
        exit;
    }
}
