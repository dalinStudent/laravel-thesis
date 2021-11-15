<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $dir = base_path('app/Supports/Facades');

        $scans = glob("$dir/*.php");
        foreach ($scans as $scan) {
            $name = basename($scan);
            if(is_file($scan)) {
                $name = basename($scan, ".php");
                $this->app->bind("{$name}", "App\Supports\Facades\Classes\\{$name}");
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
