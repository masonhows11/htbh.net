<?php

namespace App\Providers;

use App\Models\Basket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewBasketProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
        View::composer(['welcome','front.include.nav-bar'],function ($view){
           $view->with('basket_count',Basket::where('user_id','=',Auth::id())
               ->count());
        });
    }
}
