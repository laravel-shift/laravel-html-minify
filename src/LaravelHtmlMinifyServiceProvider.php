<?php

namespace DipeshSukhia\LaravelHtmlMinify;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use DipeshSukhia\LaravelHtmlMinify\BladeCompiler\ExcludeMinifyBladeCompiler;

class LaravelHtmlMinifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        Blade::directive('excludeMinify', function ($expression) {
            return app('blade.compiler')->compileExcludeMinify($expression);
        });

        Blade::directive('endExcludeMinify', function ($expression) {
            return app('blade.compiler')->compileEndExcludeMinify($expression);
        });
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/config.php' => config_path('htmlminify.php'),
            ], 'LaravelHtmlMinify');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'HtmlMinify');

        $this->app->singleton('blade.compiler', function ($app) {
            return new ExcludeMinifyBladeCompiler($app['files'], $app['config']['view.compiled']);
        });

        // Register the main class to use with the facade
        $this->app->singleton('laravel-html-minify', function () {
            return new LaravelHtmlMinifyFacade;
        });

        $this->app['router']->middleware('LaravelMinifyHtml', 'DipeshSukhia\LaravelHtmlMinify\Middleware\LaravelMinifyHtml');

        $this->app['router']->aliasMiddleware('LaravelMinifyHtml', \DipeshSukhia\LaravelHtmlMinify\Middleware\LaravelMinifyHtml::class);
        $this->app['router']->pushMiddlewareToGroup('web', \DipeshSukhia\LaravelHtmlMinify\Middleware\LaravelMinifyHtml::class);
    }
}
