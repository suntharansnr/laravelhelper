<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use View;
use App\Social;
use App\Theme;
use App\Category;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('*',function($view){
            $view->with(['social'=>Social::select('name','value')->get(),'theme'=>Theme::first(),'main_category' => Category::where('parent_id', '=',0)->select('name')->get()]);
          });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
