<?php

namespace App\Traits;

use App\Models\Advertisement\Wishlist;

trait WishlistTrait
{
    public function getCustomerWishlistProductIds(): array
    {
        if (auth('customer')->check()) {
            return Wishlist::where('customer_id', auth('customer')->id())
                        ->pluck('product_id')
                        ->toArray();
        }

        return [];
    }
}
