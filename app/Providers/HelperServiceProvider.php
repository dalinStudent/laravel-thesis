<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $dir = base_path('app/Supports/Helpers');

        $scans = glob("$dir/*.php");
        foreach ($scans as $scan) {
            if(is_file($scan)) {
                require_once($scan);
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
