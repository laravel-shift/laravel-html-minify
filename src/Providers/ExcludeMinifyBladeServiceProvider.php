<?php

namespace DipeshSukhia\LaravelHtmlMinify\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use DipeshSukhia\LaravelHtmlMinify\BladeCompiler\ExcludeMinifyBladeCompiler;

class ExcludeMinifyBladeServiceProvider extends ServiceProvider
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
	}

	/**
	 * Register the application services.
	 */
	public function register(): void
	{
		$this->app->singleton('blade.compiler', function ($app) {
			return new ExcludeMinifyBladeCompiler($app['files'], $app['config']['view.compiled']);
		});

	}
}