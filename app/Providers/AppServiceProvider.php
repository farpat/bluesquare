<?php

namespace App\Providers;

use App\Service\Asset\AssetInterface;
use App\Service\Asset\ViteAsset;
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
        $this->app->singleton(AssetInterface::class, function () {
            return new ViteAsset(
                public_path('/assets/manifest.json'),
                3000,
                '/assets'
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
