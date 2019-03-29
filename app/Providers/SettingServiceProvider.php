<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\manage\Setting;

class SettingServiceProvider extends ServiceProvider
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
        view()->composer('*', function($view){
                $setting = Setting::all();

                foreach ($setting as $getlogo) {
                    $logo = $getlogo->logo;
                    }

                return $view->with('setting', $setting)
                            ->with('logo', $logo);
            });
    }
}
