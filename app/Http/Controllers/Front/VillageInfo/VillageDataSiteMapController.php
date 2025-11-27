<?php

namespace App\Http\Controllers\Front\VillageInfo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Village;


class VillageDataSiteMapController extends Controller {

    public function __construct() {
        
    }
    
    // public function village_sitemap1() {
    //     return $this->generateVillageSitemap(0, 'village_sitemap1');
    // }
    
    // public function village_sitemap2() {
    //     return $this->generateVillageSitemap(5000, 'village_sitemap2');
    // }
    
    // public function village_sitemap3() {
    //     return $this->generateVillageSitemap(10000, 'village_sitemap3');
    // }
    
    // public function village_sitemap4() {
    //     return $this->generateVillageSitemap(15000, 'village_sitemap4');
    // }
    
    // public function village_sitemap5() {
    //     return $this->generateVillageSitemap(20000, 'village_sitemap5');
    // }
    
    // public function village_sitemap6() {
    //     return $this->generateVillageSitemap(25000, 'village_sitemap6');
    // }
    
    // public function village_sitemap7() {
    //     return $this->generateVillageSitemap(30000, 'village_sitemap7');
    // }
    
    // public function village_sitemap8() {
    //     return $this->generateVillageSitemap(35000, 'village_sitemap8');
    // }
    
    // public function village_sitemap9() {
    //     return $this->generateVillageSitemap(40000, 'village_sitemap9');
    // }
    
    // public function village_sitemap10() {
    //     return $this->generateVillageSitemap(45000, 'village_sitemap10');
    // }
    
    // public function village_sitemap11() {
    //     return $this->generateVillageSitemap(50000, 'village_sitemap11');
    // }
    
    // public function village_sitemap12() {
    //     return $this->generateVillageSitemap(55000, 'village_sitemap12');
    // }
    
    // public function village_sitemap13() {
    //     return $this->generateVillageSitemap(60000, 'village_sitemap13');
    // }
    
    // public function village_sitemap14() {
    //     return $this->generateVillageSitemap(65000, 'village_sitemap14');
    // }
    
    // public function village_sitemap15() {
    //     return $this->generateVillageSitemap(70000, 'village_sitemap15');
    // }
    
    // public function village_sitemap16() {
    //     return $this->generateVillageSitemap(75000, 'village_sitemap16');
    // }
    
    // public function village_sitemap17() {
    //     return $this->generateVillageSitemap(80000, 'village_sitemap17');
    // }
    
    // public function village_sitemap18() {
    //     return $this->generateVillageSitemap(85000, 'village_sitemap18');
    // }
    
    // public function village_sitemap19() {
    //     return $this->generateVillageSitemap(90000, 'village_sitemap19');
    // }
    
    // public function village_sitemap20() {
    //     return $this->generateVillageSitemap(95000, 'village_sitemap20');
    // }
    
    // public function village_sitemap21() {
    //     return $this->generateVillageSitemap(100000, 'village_sitemap21');
    // }
    
    // public function village_sitemap22() {
    //     return $this->generateVillageSitemap(105000, 'village_sitemap22');
    // }
    
    // public function village_sitemap23() {
    //     return $this->generateVillageSitemap(110000, 'village_sitemap23');
    // }
    
    // public function village_sitemap24() {
    //     return $this->generateVillageSitemap(115000, 'village_sitemap24');
    // }
    
    // public function village_sitemap25() {
    //     return $this->generateVillageSitemap(120000, 'village_sitemap25');
    // }
    
    // public function village_sitemap26() {
    //     return $this->generateVillageSitemap(125000, 'village_sitemap26');
    // }
    
    // public function village_sitemap27() {
    //     return $this->generateVillageSitemap(130000, 'village_sitemap27');
    // }
    
    // public function village_sitemap28() {
    //     return $this->generateVillageSitemap(135000, 'village_sitemap28');
    // }
    
    // public function village_sitemap29() {
    //     return $this->generateVillageSitemap(140000, 'village_sitemap29');
    // }
    
    // public function village_sitemap30() {
    //     return $this->generateVillageSitemap(145000, 'village_sitemap30');
    // }
    
    // public function village_sitemap31() {
    //     return $this->generateVillageSitemap(150000, 'village_sitemap31');
    // }
    
    // public function village_sitemap32() {
    //     return $this->generateVillageSitemap(155000, 'village_sitemap32');
    // }
    
    // public function village_sitemap33() {
    //     return $this->generateVillageSitemap(160000, 'village_sitemap33');
    // }
    
    // public function village_sitemap34() {
    //     return $this->generateVillageSitemap(165000, 'village_sitemap34');
    // }
    
    // public function village_sitemap35() {
    //     return $this->generateVillageSitemap(170000, 'village_sitemap35');
    // }
    
    // public function village_sitemap36() {
    //     return $this->generateVillageSitemap(175000, 'village_sitemap36');
    // }
    
    // public function village_sitemap37() {
    //     return $this->generateVillageSitemap(180000, 'village_sitemap37');
    // }
    
    // public function village_sitemap38() {
    //     return $this->generateVillageSitemap(185000, 'village_sitemap38');
    // }
    
    // public function village_sitemap39() {
    //     return $this->generateVillageSitemap(190000, 'village_sitemap39');
    // }
    
    // public function village_sitemap40() {
    //     return $this->generateVillageSitemap(195000, 'village_sitemap40');
    // }
    
    // public function village_sitemap41() {
    //     return $this->generateVillageSitemap(205000, 'village_sitemap41');
    // }
    
    // public function village_sitemap42() {
    //     return $this->generateVillageSitemap(210000, 'village_sitemap42');
    // }
    
    // public function village_sitemap43() {
    //     return $this->generateVillageSitemap(215000, 'village_sitemap43');
    // }
    
    // public function village_sitemap44() {
    //     return $this->generateVillageSitemap(220000, 'village_sitemap44');
    // }
    
    // public function village_sitemap45() {
    //     return $this->generateVillageSitemap(225000, 'village_sitemap45');
    // }
    
    // public function village_sitemap46() {
    //     return $this->generateVillageSitemap(230000, 'village_sitemap46');
    // }
    
    // public function village_sitemap47() {
    //     return $this->generateVillageSitemap(235000, 'village_sitemap47');
    // }
    
    // public function village_sitemap48() {
    //     return $this->generateVillageSitemap(240000, 'village_sitemap48');
    // }
    
    // public function village_sitemap49() {
    //     return $this->generateVillageSitemap(245000, 'village_sitemap49');
    // }
    
    // public function village_sitemap50() {
    //     return $this->generateVillageSitemap(250000, 'village_sitemap50');
    // }
    

    // public function village_sitemap1() {

    //     $villages = Village::select('id','village_slug','is_active','updated_at')
    //             ->where('is_active', '=',1)
    //             ->orderBy('id', 'desc')
    //             ->limit(1000)
    //             ->get();
            
    //     return response()->view('frontend.villageinfo.sitemaps.village_sitemap1', compact('villages'))->header('Content-Type', 'application/xml; charset=UTF-8');
    // }
    
    // private function generateVillageSitemap($offset, $viewName) {
    //     $villages = Village::select('id','village_slug','is_active','updated_at')
    //                 ->where('is_active', '=',1)
    //                 ->orderBy('id', 'desc')
    //                 ->offset($offset)
    //                 ->limit(5000)
    //                 ->get();
    
    //     return response()->view("frontend.villageinfo.sitemaps.$viewName", compact('villages'))
    //         ->header('Content-Type', 'application/xml; charset=UTF-8');
    // }
    
    public function village_sitemap($number)
    {
        $limit = 5000;
        $offset = ($number - 1) * $limit;

        $villages = Village::select('id', 'village_slug', 'is_active', 'content_updated_at')
            ->where('is_active', 1)
            ->orderBy('id', 'asc') // ✅ ascending = new records go in last file
            ->offset($offset)
            ->limit($limit)
            ->get();
            
        if ($villages->isEmpty()) {
            // Return XML with no records (but valid response)
            return response('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>', 200)
                ->header('Content-Type', 'application/xml; charset=UTF-8');
        }

        // Dynamic view name: village_sitemap1, village_sitemap2, etc.
        $viewName = "frontend.villageinfo.sitemaps.village_sitemap{$number}";

        return response()->view($viewName, compact('villages'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
    
}
