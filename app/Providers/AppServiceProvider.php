<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use Carbon\Carbon;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
     public function register()
     {
         # If running on local, set the asset version to a unique timestamp
         if (App::environment('local')) {
             $assetVersion = Carbon::now();
         # Otherwise, set it to whatever is in the config (or if not set, blank)
         } else {
             $assetVersion = config('app.assetVersion') or '';
         }

         # Make asset version available to all views
         View::share('assetVersion', $assetVersion);
     }
}
