<?php

namespace App\Providers;

use App\Models\Post;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class viewArticleProvider extends ServiceProvider
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
    public function boot()
    {
        //

        View::composer(['welcome'],function ($view) {
           $view->with('articles',Post::with('user')
               ->where('approved','=',1)
               ->orderBy('created_at','asc')
               ->take(4)->get());
        });
    }
}
