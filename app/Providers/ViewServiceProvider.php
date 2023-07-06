<?php

namespace App\Providers;

use App\View\Composers\FooterComposer;
use App\View\Composers\HeaderComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('frontend.section.header', HeaderComposer::class);
        View::composer('frontend.section.footer', FooterComposer::class);

//        View::composer('frontend.section.header', function ($view) {
//            $view->with('posts', HospitalProfile::select('*')->first());
//        });
    }
}
