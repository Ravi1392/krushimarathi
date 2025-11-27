<?php

namespace App\Traits;

use App\Models\Webstories;
use Illuminate\Support\Facades\DB;

trait VisualStoriesTrait
{
    //Home page webstories query
    public function getVisualStoriesForHome()
    {
        return Webstories::where('is_active', 1)
                    ->orderBy('id', 'desc')
                    ->limit(6)
                    ->get();
    }
    
    //in web stories menu use given query
    public function getVisualStories(){
        return Webstories::with('category:id,name')->where('is_active', 1)
                    ->orderBy('id', 'desc')
                    ->paginate(5);
    }

    //in web stories menu show cateroies, if click on any category then fire belove query
    public function getCategoryWiseWebStories($category_id){
        return Webstories::where('is_active', 1)
                    ->where('category_id','=',$category_id)
                    ->orderBy('id', 'desc')
                    ->paginate(5);
    }

    //in each category show separate web stories using this query
    public function getVisualStoriesForCategories($category_id){
        return Webstories::where('is_active', 1)
                    ->where('category_id','=',$category_id)
                    ->orderBy('id', 'desc')
                    ->limit(6)
                    ->get();
    }
    
}
