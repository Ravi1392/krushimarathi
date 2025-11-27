<?php

    function FrontMenu($parent_id = 0){
        
        $categories = DB::table('categories')
                    ->select('id','name','category_slug','is_active')
                    ->whereIn('id', [6,7,24,25,26,27])
                    // ->whereNotIn('id', [30, 31, 33, 34])
                    ->where('is_active',1)
                    ->orderBy('id','ASC')
                    ->get();
    
        if(!empty($categories)){
            
            $homeActiveClass = Request::url() === url('/') ? 'active' : '';
    
            echo '<ul class="menu sf-menu">';
            echo '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children '.$homeActiveClass.'"><a href="' .url('/'). '" style="font-size: 20px;">Home</a></li>';
            
            foreach($categories as $category)
            {
                $CatpageUrl = url('/' . $category->category_slug);
                $Catactive = ((Request::url() === $CatpageUrl) || (Request::segment(1) === $category->category_slug)) ? 'active' : '';
    
                echo '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children '.$Catactive.'"><a href="'.$CatpageUrl.'" style="font-size: 20px;">'.$category->name.'</a></li>';
            }
            echo '</ul>';
        }
    }
    
    function FrontMenuOld($parent_id = 0){
        
        $categories = DB::table('categories')
                    ->select('id','name','category_slug','is_active')
                    ->whereNotIn('id', [30, 31, 33, 34])
                    ->where('is_active',1)
                    ->orderBy('id','ASC')
                    ->get();
    
        if(!empty($categories)){
            
            $homeActiveClass = Request::url() === url('/') ? 'active' : '';
    
            echo '<ul class="menu sf-menu">';
            echo '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children '.$homeActiveClass.'"><a href="' .url('/'). '" style="font-size: 20px;">होम</a></li>';
            
            foreach($categories as $category)
            {
    
                // Fetch Subcategories
                $subcategories = DB::table('sub_categories')
                                ->select('id','name','subcategory_slug','category_id','is_active')
                                ->where('is_active',1)
                                ->where('category_id', $category->id)
                                ->orderBy('id','ASC')
                                ->get();
    
                $CatpageUrl = url('/' . $category->category_slug);
                $Catactive = ((Request::url() === $CatpageUrl) || (Request::segment(1) === $category->category_slug)) ? 'active' : '';
    
                $hasActiveSubcategory = false;
                foreach($subcategories as $subcategory) {
                    if (Request::segment(2) === $subcategory->subcategory_slug) {
                        $hasActiveSubcategory = true;
                        break;
                    }
                }
    
                if ($hasActiveSubcategory) {
                    $Catactive = 'active';
                }
    
                echo '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children '.$Catactive.'"><a href="'.$CatpageUrl.'" style="font-size: 20px;">'.$category->name;
    
                if(!$subcategories->isEmpty()){
                    echo '<span role="presentation">
                            <span class="gp-icon icon-arrow">
                                <svg viewBox="0 0 330 512" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em">
                                <path d="M305.913 197.085c0 2.266-1.133 4.815-2.833 6.514L171.087 335.593c-1.7 1.7-4.249 2.832-6.515 2.832s-4.815-1.133-6.515-2.832L26.064 203.599c-1.7-1.7-2.832-4.248-2.832-6.514s1.132-4.816 2.832-6.515l14.162-14.163c1.7-1.699 3.966-2.832 6.515-2.832 2.266 0 4.815 1.133 6.515 2.832l111.316 111.317 111.316-111.317c1.7-1.699 4.249-2.832 6.515-2.832s4.815 1.133 6.515 2.832l14.162 14.163c1.7 1.7 2.833 4.249 2.833 6.515z"></path>
                                </svg>
                            </span>
                        </span>';
                }
    
                echo '</a>';
                
                if(!$subcategories->isEmpty()){
                    
                    echo '<ul class="sub-menu">';
                    foreach($subcategories as $subcategory) {
                        $SubcatPageUrl = url('/' . $category->category_slug . '/' . $subcategory->subcategory_slug);
                        $SubcatActive = (Request::segment(2) === $subcategory->subcategory_slug) ? 'active' : '';
                        echo '<li class="menu-item menu-item-type-custom menu-item-object-custom '.$SubcatActive.'">
                                    <a href="'.$SubcatPageUrl.'" style="font-size: 18px;">'.$subcategory->name.'</a>
                            </li>';
                    }
                    echo '</ul>';
                }
                
                echo '</li>';
            }
            echo '</ul>';
        }
    }
    
    //1st Menu (Quick Link)
    function FooterMenu(){
        
        $homeActiveClass = Request::url() === url('/') ? 'active' : '';
        
        $footercategories = DB::table('footer_categories')
                    ->select('id','name','category_slug','is_active')
                    ->whereNull('deleted_at')
                    ->where('is_active', '=',1)
                    ->orderBy('id','ASC')
                    ->limit(5)
                    ->get();
    
                    echo '<ul class="menu">';
                    foreach($footercategories as $footer)
                    {
                        $pageUrl = url('/' . $footer->category_slug);
                        $active = ((Request::url() === $pageUrl) || (Request::segment(1) === $footer->category_slug)) ? 'menu_active' : '';
                        $footerActiveClass = Request::url() === url('/') ? 'menu_active' : '';
                        echo '<li class="menu-item menu-item-type-post_type menu-item-object-page '.$active.'">
                            <a href="'.$pageUrl.'">'.$footer->name.'</a>
                        </li>';
                    }
                    echo '</ul>';
    }

    //2nd Menu (Other Links)
    function FooterMenuFour(){
        
        $homeActiveClass = Request::url() === url('/') ? 'active' : '';
        
        $footercategories = DB::table('footer_categories')
                    ->select('id','name','category_slug','is_active')
                    ->whereNull('deleted_at')
                    ->where('is_active', '=',1)
                    ->orderBy('id','ASC')
                    ->skip(5)
                    ->limit(5)
                    ->get();
    
                    echo '<ul class="menu">';
                    foreach($footercategories as $footer)
                    {
                        $pageUrl = url('/' . $footer->category_slug);
                        $active = ((Request::url() === $pageUrl) || (Request::segment(1) === $footer->category_slug)) ? 'menu_active' : '';
                        $footerActiveClass = Request::url() === url('/') ? 'menu_active' : '';
                        echo '<li class="menu-item menu-item-type-post_type menu-item-object-page '.$active.'">
                            <a href="'.$pageUrl.'">'.$footer->name.'</a>
                        </li>';
                    }
                    echo '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="' .url('/krushi-tech-ai'). '">Krushi Tech AI</a></li>';
                    echo '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="' .url('/ads'). '">BUY, SELL & RENT</a></li>';
                    echo '</ul>';
    }

    //3rd Menu (Category Link)
    function FooterMenuTwo(){
        $homeActiveClass = Request::url() === url('/') ? 'active' : '';
        
        $categories = DB::table('categories')
                    ->select('id','name','category_slug','is_active')
                    ->whereIn('id', [22, 23, 30, 31, 33, 34])
                    ->whereNotIn('id', [6,7,24,25,26,27,32])
                    ->whereNull('deleted_at')
                    ->where('is_active', '=',1)
                    ->orderBy('id','ASC')
                    ->limit(5)
                    ->get();
    
                    echo '<ul class="menu">';
                    foreach($categories as $category)
                    {
                        $pageUrl = url('/' . $category->category_slug);
                        $active = ((Request::url() === $pageUrl) || (Request::segment(1) === $category->category_slug)) ? 'menu_active' : '';
                        $footerActiveClass = Request::url() === url('/') ? 'menu_active' : '';
                        echo '<li class="menu-item menu-item-type-post_type menu-item-object-page '.$active.'">
                            <a href="'.$pageUrl.'">'.$category->name.'</a>
                        </li>';
                    }
                    echo '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="' .url('/ads/todays-bajarbhav'). '">Market Price</a></li>';
                    echo '</ul>';
    }
    
    //4th Menu (Special Links)
    function FooterMenuThree(){
        $homeActiveClass = Request::url() === url('/') ? 'active' : '';
        
        $special_categories = DB::table('special_categories')
                    ->select('id','name','category_slug','is_active')
                    ->whereNull('deleted_at')
                    ->whereNotIn('id', [8])
                    ->where('is_active', '=',1)
                    ->orderBy('id','ASC')
                    ->limit(6)
                    ->get();
        
        $categories = DB::table('categories')
                ->select('id','name','category_slug','is_active')
                ->whereIn('id', [31])
                ->where('is_active',1)
                ->orderBy('id','ASC')
                ->get();
    
        echo '<ul class="menu">';
            if(!empty($special_categories)){
                
                foreach($special_categories as $category)
                {
                    $pageUrl = url('/' . $category->category_slug);
                    $active = ((Request::url() === $pageUrl) || (Request::segment(1) === $category->category_slug)) ? 'menu_active' : '';
                    $footerActiveClass = Request::url() === url('/') ? 'menu_active' : '';
                    echo '<li class="menu-item menu-item-type-post_type menu-item-object-page '.$active.'">
                        <a href="'.$pageUrl.'">'.$category->name.'</a>
                    </li>';
                }
            }
            
            if(!empty($categories)){
    
                foreach($categories as $header_category)
                {
                    $pageUrl = url('/' . $header_category->category_slug);
                    $active = ((Request::url() === $pageUrl) || (Request::segment(1) === $header_category->category_slug)) ? 'menu_active' : '';
                    $footerActiveClass = Request::url() === url('/') ? 'menu_active' : '';
                    echo '<li class="menu-item menu-item-type-post_type menu-item-object-page '.$active.'">
                        <a href="'.$pageUrl.'">'.$header_category->name.'</a>
                    </li>';
                }
            }
            
        echo '</ul>';
    }
    
    
    
    function getSettingsGoogleAdsInfo(){
    	$result = DB::table('settings')->where('key',"=",'google_ads')->value('value');
    	if(!empty($result)){
    		return $result;
    	}else{
    		return null;
    	}
    }
    
    function getSettingsGoogleTagInfo(){
    	$result = DB::table('settings')->where('key',"=",'google_tag')->value('value');
    	if(!empty($result)){
    		return $result;
    	}else{
    		return null;
    	}
    }
    
    function GetSlug($name){
    	$str = str_replace('-', ' ', $name);
        $str = ucfirst($str);
    	return $str;
    }
    
    function StrLimit($string, $wordLimit) {
        // Split the string into words
        $words = preg_split('/\s+/', trim($string));
    
        // Check if the word count exceeds the limit
        if (count($words) > $wordLimit) {
            // Limit the words and append ellipsis
            return implode(' ', array_slice($words, 0, $wordLimit)) . ' ...';
        } else {
            // If within limit, return the original string
            return $string;
        }
    }
    
    function BlogCount($id){
    
        return $count = DB::table('blogs')->where('category_id', '=', $id)->where('is_active','=',1)->count();
    
    }
    
    //Marquee code
    function LatestBlogs(){
    
        $latestBlogs = DB::table('blogs')->select('id','blog_title','blog_slug','is_active')->where('is_active','=',1)->orderBy('id','desc')->limit(5)->get();
    
        if(isset($latestBlogs) && !empty($latestBlogs)){
            echo '<div class="container">';
            echo '<div class="row">';
            echo '<div class="col-md-12">';
            echo '<div class="breaking-news">';
            echo '<div class="news">';
            echo '<span class="d-flex align-items-center">&nbsp;Latest</span>';
            echo '</div>';
            echo '<marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">';
    
            foreach($latestBlogs as $latestBlog){
                $url = route('blog.view', ['blog_slug' => $latestBlog->blog_slug]);
                
                echo '<span class="dot"></span>';
                echo '<a href="' . $url . '" style="color: #ffffff;font-size: 20px;">'.$latestBlog->blog_title.'</a>';
            }
            echo '</marquee>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    
    }
    
    //Advertise module marquee code
    function MarqueeLatestBlogs(){
    
        $latestBlogs = DB::table('blogs')->select('id','blog_title','blog_slug','is_active')->where('is_active','=',1)->orderBy('id','desc')->limit(5)->get();
    
        if(isset($latestBlogs) && !empty($latestBlogs)){
            echo '<div class="row" style="margin: unset;">';
            echo '<div class="col-md-12" style="padding: unset;">';
            echo '<div class="breaking-news">';
            echo '<div class="news">';
            echo '<span class="d-flex align-items-center">&nbsp;Latest</span>';
            echo '</div>';
            echo '<marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">';
    
            foreach($latestBlogs as $latestBlog){
                $url = route('blog.view', ['blog_slug' => $latestBlog->blog_slug]);
                
                echo '<span class="dot"></span>';
                echo '<a href="' . $url . '" style="color: #ffffff;font-size: 20px;">'.$latestBlog->blog_title.'</a>';
            }
            echo '</marquee>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    
    }
    
    //code for 404 Errors Sidebar Blogs
    
    function ErrorLatestBlogs(){
    
        $latestBlogs = DB::table('blogs')->select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active')
                    ->where('is_active', '=', 1)
                    ->orderBy('id', 'desc')
                    ->limit(3)
                    ->get();
    
        if(isset($latestBlogs) && !empty($latestBlogs)){
            
            foreach($latestBlogs as $latestBlog){
                $url = route('blog.view', ['blog_slug' => $latestBlog->blog_slug]);
    
                $imagePath = asset('public/assets/admin/images/blog_image/' . $latestBlog->blog_image);
    
                echo '<li class="list-group-item d-flex align-items-center">';
                echo '<img src="'.$imagePath.'" alt="'.$latestBlog->blog_title.'" title="'.$latestBlog->blog_title.'" class="me-2" style="width: 170px;
        height: 90px; object-fit: cover; border-radius: 5px;">';
                echo '<a href="' . $url . '" class="text-decoration-none">'.
                                    $latestBlog->blog_title
                                .'</a>';
                echo '</li>';
            }
        }
    
    }
    
    function ErrorTrendingBlogs(){
    
        $latestBlogs = DB::table('blogs')->select('id', 'category_id', 'sub_category_id', 'blog_title', 'blog_slug', 'blog_image', 'is_active', 'created_at', 'views')
                    ->where('is_active', '=', 1)
                    ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-90 days')))
                    ->orderBy('views', 'desc')
                    ->limit(3)
                    ->get();
    
        if(isset($latestBlogs) && !empty($latestBlogs)){
            
            foreach($latestBlogs as $latestBlog){
                $url = route('blog.view', ['blog_slug' => $latestBlog->blog_slug]);
    
                $imagePath = asset('public/assets/admin/images/blog_image/' . $latestBlog->blog_image);
    
                echo '<li class="list-group-item d-flex align-items-center">';
                echo '<img src="'.$imagePath.'" alt="'.$latestBlog->blog_title.'" title="'.$latestBlog->blog_title.'" class="me-2" style="width: 170px;
        height: 90px; object-fit: cover; border-radius: 5px;">';
                echo '<a href="' . $url . '" class="text-decoration-none">'.
                                    $latestBlog->blog_title
                                .'</a>';
                echo '</li>';
            }
        }
    
    }
    
    //below function use for ads portal
    
    if (!function_exists('generateRandomPassword')) {
        function generateRandomPassword($length = 6) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $password = '';
            
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[random_int(0, strlen($characters) - 1)];
            }
            
            return $password;
        }
    }
    
    if (!function_exists('getLocalizedColumn')) {
    
        function getLocalizedColumn($table, $lang, $fallback = 'en_name') {
            $map = [
                'en' => 'en_name',
                'mr' => 'mr_name',
                'hi' => 'hi_name',
            ];
    
            $column = $map[$lang] ?? $fallback;
    
            if (!Schema::hasColumn($table, $column)) {
                return $fallback;
            }
    
            return $column;
        }
    }
    
    if (!function_exists('formatNumberShort')) {
        function formatNumberShort($number, $precision = 1)
        {
            if ($number < 1000) {
                return $number . '+';
            }
    
            $units = ['', 'K', 'M', 'B', 'T'];
            $power = (int) floor(log($number, 1000));
            $shortNumber = $number / pow(1000, $power);
    
            return number_format($shortNumber, $precision) . $units[$power] . '+';
        }
    }

?>
