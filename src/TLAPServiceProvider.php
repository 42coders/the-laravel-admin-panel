<?php

namespace the42coders\TLAP;

use Illuminate\Support\ServiceProvider;

class TLAPServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tlap');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'tlap');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('tlap.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/tlap'),
            ], 'views');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../public/css' => public_path('vendor/tlap/css'),
                __DIR__.'/../public/js' => public_path('vendor/tlap/js'),
                __DIR__.'/../public/fonts' => public_path('public/fonts'),
            ], 'assets');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/tlap'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'tlap');

        // Register the main class to use with the facade
        $this->app->singleton('tlap', function () {
            return new TLAP;
        });
    }
}
