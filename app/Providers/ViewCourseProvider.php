<?php

namespace App\Providers;

use App\Models\Course;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewCourseProvider extends ServiceProvider
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
            $view->with('courses',Course::orderBy('created_at','asc')->where('status_publish','=',1)->take(4)->get());
        });
    }
}
