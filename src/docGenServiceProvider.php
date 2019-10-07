<?php

namespace  KeTo7t\docgen;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class docGenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'phpSpreadSheet_styles');

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
        return __DIR__ . '/Excel/styles.config.php';
    }
}
