<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        view()->composer('layouts.sysadmin', function($view) {
            $breadcrumb = request()->segments();

            //change _ to space
            $breadcrumb = array_map(
                'str_replace',
                array_fill(0, count($breadcrumb), '_'),
                array_fill(0, count($breadcrumb), ' '),
                $breadcrumb
            );

            //destroy 1st item (sysadmin)
            $breadcrumb = array_slice($breadcrumb, 1, 2);

            // 1st letter is capital
            $breadcrumb = array_map('ucwords', $breadcrumb);

            $view->with('breadcrumb', implode(' / ', $breadcrumb));

            //user
            $view->with('user', \Auth::user());

        });
    }


}
