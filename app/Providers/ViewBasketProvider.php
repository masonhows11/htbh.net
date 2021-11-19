<?php

namespace App\Providers;

use App\Models\ShoppingBasket;
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
        View::composer(['welcome'],function ($view){
           $view->with('basket_count',ShoppingBasket::where('user_id','=',Auth::id())
               ->count());
        });
    }
}
