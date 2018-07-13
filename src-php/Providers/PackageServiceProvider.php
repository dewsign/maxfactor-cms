<?php

namespace Maxfactor\CMS\Providers;

use Barryvdh\Cors\HandleCors;
use Illuminate\Routing\Router;
use Maxfactor\CMS\Commands\MakeAdmin;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->registerCors($router);
        $this->bootAssets();
        $this->bootViews();
        $this->bootCommands();
        $this->publishDatabaseFiles();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the artisan packages' terminal commands
     *
     * @return void
     */
    private function bootCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeAdmin::class,
            ]);
        }
    }

    /**
     * Load custom views
     *
     * @return void
     */
    private function bootViews()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'maxfactor');
        $this->publishes([
            __DIR__.'/../Resources/views' => resource_path('views/vendor/maxfactor'),
        ]);
    }

    /**
     * Define publishable assets
     *
     * @return void
     */
    private function bootAssets()
    {
        $this->publishes([
            __DIR__.'/../Resources/assets/js' => resource_path('assets/js/vendor/maxfactor'),
        ], 'js');
    }

    /**
     * Make CORS middleware available to routes
     *
     * @param Router $router
     * @return void
     */
    private function registerCors(Router $router)
    {
        $router->aliasMiddleware('cors', HandleCors::class);
    }

    private function publishDatabaseFiles()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(
            __DIR__ . '/../Database/factories'
        );

        $this->publishes([
            __DIR__ . '/../Database/factories' => base_path('database/factories')
        ], 'factories');

        $this->publishes([
            __DIR__ . '/../Database/migrations' => base_path('database/migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../Database/seeds' => base_path('database/seeds')
        ], 'seeds');
    }
}
