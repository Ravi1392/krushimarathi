<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $googleAdsInfo = DB::table('settings')->where('key', 'google_ads')->value('value');
        $googleTagInfo = DB::table('settings')->where('key', 'google_tag')->value('value');
        $AdBlockingRecovery = DB::table('settings')->where('key', 'ad_blocking_recovery')->value('value');

        // Share the data with all views
        View::share('googleAdsInfo', $googleAdsInfo);
        View::share('googleTagInfo', $googleTagInfo);
        View::share('AdBlockingRecovery', $AdBlockingRecovery);
    }
}
