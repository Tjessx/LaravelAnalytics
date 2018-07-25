<?php

namespace BertBijnens\LaravelAnalytics;

use BertBijnens\LaravelAnalytics\Commands\SyncLogs;
use BertBijnens\LaravelAnalytics\Middleware\LogMiddleware;
use BertBijnens\LaravelAnalytics\Providers\DatabaseProvider;

use Illuminate\Support\ServiceProvider;

class LaravelAnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        DatabaseProvider::setup();

        if($this->app->runningInConsole()) {

            $this->commands([
                SyncLogs::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__. '/routes/routes.php');
        //$this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'analytics');

        $this->app['Illuminate\Contracts\Http\Kernel']->prependMiddleware(LogMiddleware::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}