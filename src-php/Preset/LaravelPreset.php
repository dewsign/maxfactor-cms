<?php

namespace Maxfactor\CMS\Preset;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\Presets\Preset;

class LaravelPreset extends Preset
{
    public static function install()
    {
        static::updateMix();
        static::updateViews();
        static::updateRoutes();
        static::updateControllers();
        static::updateModels();
        // static::updateStyles();
        // static::updateScripts();
        static::updatePackages();
    }

    /**
     * Update npm packages to include only those required for the CMS to function
     *
     * @param array $packages
     * @return void
     */
    public static function updatePackageArray($packages)
    {
        return array_merge([
            '@thesold/x-model' => '^1.0.1',
            'ajax-store' => '^1.0.6',
            'browser-sync' => '2.24.5',
            'browser-sync-webpack-plugin' => '2.2.2',
            'vue' => '^2.5.16',
            'vue-router' => '^3.0.1',
            'vuetify' => '^1.1.4',
            'vuex' => '^3.0.1',
        ], Arr::except($packages, [
            'popper.js',
            'lodash',
            'jquery',
            'bootstrap',
        ]));
    }

    /**
     * Prepare build tools without default Mix configuration
     *
     * @return void
     */
    public static function updateMix()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     * Removes all default controllers and replaces them with Maxfactor CMS controllers
     *
     * @return void
     */
    public static function updateControllers()
    {
        File::cleanDirectory(base_path('app/Http/Controllers'));
        File::copyDirectory(self::stubsFolder('app/Http/Controllers'), base_path('app/Http/Controllers'));
    }

    /**
     * Replaces existing models (e.g. User) and adds any additional models required by the default
     * Maxfactor CMS installation.
     *
     * @return void
     */
    public static function updateModels()
    {
        File::copyDirectory(self::stubsFolder('app/Models'), base_path('app'));
    }

    /**
     * Replaces all default routes with Maxfactor CMS routes
     *
     * @return void
     */
    public static function updateRoutes()
    {
        File::cleanDirectory(base_path('routes'));
        File::copyDirectory(self::stubsFolder('routes'), base_path('routes'));
    }

    /**
     * Deletes all default views and replaces them with essential Maxfactor views
     *
     * @return void
     */
    public static function updateViews()
    {
        File::cleanDirectory(resource_path('views'));
        File::copyDirectory(self::stubsFolder('views'), resource_path('views'));
    }

    /**
     * Deletes all default javascript and installs Maxfactor CMS scaffolding
     *
     * @return void
     */
    public static function updateScripts()
    {
        File::cleanDirectory(resource_path('assets/js'));
        File::copyDirectory(self::stubsFolder('assets/js'), resource_path('assets/js'));
    }

    /**
     * Deletes all default style files and install Maxfactor Sass
     *
     * @return void
     */
    public static function updateStyles()
    {
        File::cleanDirectory(resource_path('assets/sass'));

        copy(__DIR__.'/stubs/app.sass', resource_path('assets/sass/app.sass'));
    }

    /**
     * Helper method to concatenate the stubs folder location
     *
     * @param string $file
     * @return string
     */
    private static function stubsFolder(string $file = null)
    {
        return __DIR__.'/stubs/'.$file;
    }
}
