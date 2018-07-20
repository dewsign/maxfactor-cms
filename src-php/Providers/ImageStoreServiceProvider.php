<?php

namespace Maxfactor\CMS\Providers;

use Maxfactor\CMS\Modules\ImageStore;
use Illuminate\Support\ServiceProvider;

class ImageStoreServiceProvider extends ServiceProvider
{
    /**
     * The name of the configuration key
     *
     * @var string
     */
    protected $config = 'imagestore';

    public function boot()
    {
        $this->publishConfig();
    }

    public function register()
    {
        $this->bindFacade();
        $this->mergeConfig();
    }

    /**
     * Publishes the configuration to the project for customisation on vendor:publish
     *
     * @return void
     */
    private function publishConfig()
    {
        $this->publishes([
            __DIR__."/../Configs/{$config}.php" => config_path("{$config}.php"),
        ]);
    }

    /**
     * Makes the config available without needing to publish it into the project
     *
     * @return void
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__."/../Configs/{$config}.php", $config);
    }

    /**
     * Binds the ImageStore module to the Facade accessor to allow us to potentially switch it for
     * a different image hosting service.
     *
     * @return void
     */
    private function bindFacade()
    {
        $this->app->singleton('image-store', ImageStore::class);
    }
}
