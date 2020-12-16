<?php

namespace App\Providers;

use App\Models\Tenants\Setting\Setting;
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
        View::composer('*', function($view) {
            $view->with([
                'skin' => Setting::find(1)->value,
                'theme' => Setting::find(2)->value,
                'locale' => Setting::find(3)->value
            ]);
        });


    }
}
