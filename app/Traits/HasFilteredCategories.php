<?php

namespace App\Traits;

use App\Models\Advertisement\Category;

trait HasFilteredCategories
{
    public function getFilteredCategories($lang)
    {
        return Category::active()
            ->withCount(['products as product_count' => function ($query) use ($lang) {
                $query->active()->status()
                    ->where('language_code', $lang);
            }])
            ->whereHas('products', function ($q) use ($lang) {
                $q->active()->status()
                    ->where('language_code', $lang);
            })
            ->select('id', "{$lang}_name as name", 'slug')
            ->get();
    }

    public function getFilteredCategoriesWithSubcategories($lang)
    {
        return Category::active()
            ->with(['subcategories' => function ($query) use ($lang) {
                $query->active()
                    ->whereHas('products', function ($q) use ($lang) {
                        $q->active()->status()
                            ->where('language_code', $lang);
                    })
                    ->select('id', "{$lang}_name as name", 'slug', 'ads_category_id');
            }])
            ->whereHas('products', function ($q) use ($lang) {
                $q->active()->status()
                    ->where('language_code', $lang);
            })
            ->select('id', "{$lang}_name as name", 'slug')
            ->get();
    }
}
