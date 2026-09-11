<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use \App\ProductCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
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
        // dd(\Request::capture()->route());
        view()->composer('*',function($view){
            $model=false;
            $request=$this->app->request->route();
            if($request){
                if($request->parameters()){
                    foreach ($request->parameters() as $key => $value) {
                        $model=$value;
                        break;
                    }
                }    
            }
            $view->with('model',(($model)?$model:false));
        });
        view()->composer('*',function($view){
        if(($global_discount=\App\Parametrization::where("parameter","global_discount")->first())){
            if(!empty($global_discount->value)){
                $view->with('global_discount',$global_discount->value);
            }
        }
        });
        if(\App::environment()=="production"){
            \URL::forceRootUrl('https://www.recuperatfisioterapia.com');
            \URL::forceScheme('https');
        }
        view()->share('SESSION_products', \Session::get("IDs_cart_products"));
        if(Schema::hasTable('product_categories')){
            View::share('categories', ProductCategory::all());
        }
    }
}
