<?php

namespace Innerent\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class FoundationServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('foundation.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'foundation'
        );

        $this->publishes([
            __DIR__.'/../Config/auth.php' => config_path('auth.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../Config/cors.php' => config_path('cors.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../Config/json-api-paginate.php' => config_path('json-api-paginate.php'),
        ], 'config');

        // Overrides config files
        $this->app['config']->set('auth', require __DIR__.'/../Config/auth.php');
        $this->app['config']->set('json-api-paginate', require __DIR__.'/../Config/json-api-paginate.php');
        $this->app['config']->set('cors', require __DIR__.'/../Config/cors.php');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/foundation');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/foundation';
        }, \Config::get('view.paths')), [$sourcePath]), 'foundation');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/foundation');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'foundation');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'foundation');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
