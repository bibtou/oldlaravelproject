<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class ViewServiceProvider extends ServiceProvider
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
		Paginator::defaultSimpleView('blog.includes.part-simple-pagination');
        View::composer('blog.layouts.default', 'App\Http\View\Composers\BlogAsideComposer');
    }
}
