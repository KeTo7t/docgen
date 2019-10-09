<?php

namespace  KeTo7t\docgen;

use Illuminate\Support\ServiceProvider;

class docgenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'sheet_format');

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([docgen::class]);
        }
    }

    protected function configPath()
    {
        return __DIR__ . '/Excel/format.config.php';
    }
}
