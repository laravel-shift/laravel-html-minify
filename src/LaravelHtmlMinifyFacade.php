<?php

namespace DipeshSukhia\LaravelHtmlMinify;

use DipeshSukhia\LaravelHtmlMinify\BladeCompiler\ExcludeMinifyBladeCompiler;
use Illuminate\Support\Facades\Facade;

class LaravelHtmlMinifyFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() : string {
		return 'laravel-html-minify';
	}

	/**
	 * @param $html
	 * @return string
	 */
	public static function htmlMinify( ?string $html = NULL ) : string {
		return ( new LaravelHtmlMinify() )->htmlMinify( ( string ) $html );
	}

	/**
	 * @param $html
	 * @return string
	 */
	public static function excludeHtmlMinify( ?string $html = NULL ) : string {
		return ExcludeMinifyBladeCompiler::EXCLUDESTART . ( string ) $html . ExcludeMinifyBladeCompiler::EXCLUDEEND;
	}
}
