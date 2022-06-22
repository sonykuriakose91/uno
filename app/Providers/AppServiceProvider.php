<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Settings;
use App\Models\Providers;
use App\Models\Countries;

use Illuminate\Support\Facades\View;

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
        config(['site_settings' => Settings::first()]);

        $online_providers = Providers::with('providercategories')->select('providers.*','users.user_type','users.user_id')->join('users', 'providers.id', '=', 'users.user_id')->where(['users.user_type' => "provider", 'users.status' => 1, 'users.loggedIN' => 1])->orderBy('providers.rating','desc')->get();

        $countries = Countries::get();

        View::share('online_providers',$online_providers);

        View::share('countries',$countries);
    }
}
