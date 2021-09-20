<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setLocale(LC_ALL,"id_ID.utf8");

        Carbon::setLocale("id_ID.utf8");
        
        date_default_timezone_set('Asia/Jakarta');
                
        if(config('app.env') == "production"){
            try{
                \DB::connection()->getPdo();
            }catch(\Exception $e){
                abort(503);
            }
        }

        try{
            \Config::set('app.isMobile',preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]));
        }catch(\Exception $e){            
            \Config::set('app.isMobile',false);
        }       
    }
}
