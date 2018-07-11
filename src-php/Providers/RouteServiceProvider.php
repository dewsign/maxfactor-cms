<?php

namespace Maxfactor\CMS\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Maxfactor\CMS\Http\Controllers';

    /**
     * This is the namespace of the default Laravel Project
     *
     * @var string
     */
    protected $appNamespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapAuthRoutes();
        $this->mapAdminRoutes();
    }

    /**
     * Define the "auth" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAuthRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace . '\Auth')
             ->group(__DIR__ . ('/../Routes/auth.php'));
    }

    /**
     * Automatically load admin routes in the main project.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        /**
         * Because the admin routes file is installed by the Laravel Preset it may not exist when
         * the service provider is first loaded, so we run this check and bail to avoid errors.
         */
        if (!File::exists(base_path('routes/admin.php'))) {
            return;
        }

        Route::middleware('web')
             ->namespace($this->appNamespace)
             ->group(base_path('routes/admin.php'));
    }
}
