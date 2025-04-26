<?php

namespace Surge;

use Illuminate\Support\ServiceProvider;

/**
 * SurgeServiceProvider bootstraps the Surge package.
 */
class SurgeServiceProvider extends ServiceProvider
{
    /**
     * Register bindings and merge configurations.
     */
    public function register(): void
    {
        // Merge package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/surge.php', 'surge');

        // Bind Surge facade to the Surge class
        $this->app->singleton('surge', function ($app) {
            return new Surge();
        });

        // Register console commands if running in console
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\StartSurge::class,
                Console\StopSurge::class,
                Console\RestartSurge::class,
                Console\StatusSurge::class,
            ]);
        }
    }

    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        // Publish configuration file
        $this->publishes([
            __DIR__ . '/../config/surge.php' => config_path('surge.php'),
        ], 'config');

        // Load web routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load and publish views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'surge');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/surge'),
        ], 'views');
    }
}
