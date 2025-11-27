<?php

namespace App\Http\Controllers\Advertisement\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Advertisement\Wishlist;
use Mail;
use App\Traits\WishlistTrait;

class WishlistController extends Controller
{

    use WishlistTrait;

    public function wishlist(Request $request)
    {

        $customer = auth('customer')->user();
        $productId = $request->product_id;

        $wishlist = Wishlist::where('customer_id', $customer->id)
                            ->where('product_id', $productId)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        } else {

            $wishlist = Wishlist::withTrashed()
            ->where('customer_id', $customer->id)
            ->where('product_id', $productId)
            ->first();

           if ($wishlist) {
                if ($wishlist->trashed()) {
                    $wishlist->restore();
                }
            } else {
                Wishlist::create([
                    'customer_id' => $customer->id,
                    'product_id' => $productId,
                ]);
            }

            return response()->json(['status' => 'added']);
        }
    }
    
    public function my_wishlist()
    {
        $customer = auth('customer')->user();

        $lang = session('locale', 'en');

        $stateColumn = getLocalizedColumn('states', $lang);
        $districtColumn = getLocalizedColumn('districts', $lang);
        $talukaColumn = getLocalizedColumn('talukas', $lang);
        $villageColumn = getLocalizedColumn('villages', $lang);

        $my_wishlists = Wishlist::with([
            'products' => function ($query) use ($lang, $stateColumn, $districtColumn, $talukaColumn, $villageColumn) {
                $query->select('id', 'category_id', 'sub_category_id', 'unit_id', 'state_id', 'district_id', 'customer_id', 'language_code', 'lead_type', 'title', 'slug', 'photo', 'price', 'address_link', 'views', 'created_at')
                    ->with([
                        "category:id,slug",
                        "subcategory:id,{$lang}_name as name,slug",
                        "unit:id,{$lang}_name as name",
                        "state:id,{$stateColumn} as name",
                        "district:id,{$districtColumn} as name",

                        // customer with nested state/district
                        'customer' => function ($q) use ($stateColumn, $districtColumn, $talukaColumn, $villageColumn) {
                            $q->select('id', 'name', 'last_name', 'state_id', 'district_id')
                                ->with([
                                    "state:id,{$stateColumn} as name",
                                    "district:id,{$districtColumn} as name",
                                    "taluka:id,{$talukaColumn} as name",
                                    "village:id,{$villageColumn} as name",
                                ]);
                        }
                    ])->active();
            }
        ])
        ->where('customer_id', $customer->id)
        ->latest('id')
        ->get();

        $wishlistProductIds = $this->getCustomerWishlistProductIds();

        return view('advertisement.dashboard.wishlist.my_wishlist', [
            'my_wishlists' => $my_wishlists,
            'wishlistProductIds' => $wishlistProductIds
        ]);
    }

}
