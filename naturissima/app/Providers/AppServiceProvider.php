<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use \App\ProductCategory;
use Illuminate\Support\Facades\Schema;
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
        date_default_timezone_set('America/Mexico_City');
        if(\App::environment()=="production"){
            \URL::forceRootUrl('https://www.naturissimafarmacia.com');
            \URL::forceScheme('https');
        }
        view()->share('SESSION_products', \Session::get("IDs_cart_products"));
        if(Schema::hasTable('product_categories')){
            View::share('categories', ProductCategory::all());
        }
    }
}
