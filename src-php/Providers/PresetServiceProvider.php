<?php
namespace Maxfactor\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Maxfactor\CMS\Preset\LaravelPreset;
use Illuminate\Foundation\Console\PresetCommand;

class PresetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('maxfactor', function ($command) {
            LaravelPreset::install();

            $command->info('Maxfactor CMS Preset installed. Please compile your assets!');
        });
    }
}
