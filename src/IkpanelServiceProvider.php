<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel;

use ikdev\ikpanel\app\Classes\Exception\ExceptionReporting;
use ikdev\ikpanel\app\Exception\IkpanelExceptionHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Storage;

class IkpanelServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->app->bind(ExceptionHandler::class, IkpanelExceptionHandler::class);
		$this->publishes([
			__DIR__ . '/public'                    => public_path('ikpanel/'),
			__DIR__ . '/resources/assets'          => resource_path('assets/'),
			__DIR__ . '/resources/lang/vendor'     => resource_path('lang/vendor'),
			__DIR__ . '/config/ikpanel-config.php' => base_path('config/ikpanel-config.php'),
			__DIR__ . '/config/backup.php'         => base_path('config/backup.php'),
			__DIR__ . '/config/database.php'       => base_path('config/database.php'),
			__DIR__ . '/app/Http/Kernel.php'       => app_path('Http/Kernel.php'),
		], 'ikpanel');
		
		$this->loadRoutesFrom(__DIR__ . '/routes/web.php');
		$this->loadMigrationsFrom(__DIR__ . '/database/migrations');
		$this->loadViewsFrom(__DIR__ . '/resources/view', 'ikpanel');
		$this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'ikpanel');
		
		// BLOG MODULE
		$this->loadMigrationsFrom(__DIR__ . '/Modules/blog/database/migrations');
		$this->loadViewsFrom(__DIR__ . '/Modules/blog/resources/view', 'ikpanel-blog');
		$this->loadRoutesFrom(__DIR__ . '/Modules/blog/routes/web.php');
		$this->loadTranslationsFrom(__DIR__ . '/Modules/blog/resources/lang', 'ikpanel-blog');
		
		$this->publishes([
			__DIR__ . '/Modules/blog/public/js' => public_path('ikpanel/modules/blog/js')
		], 'ikpanel-blog');
		
		// GALLERY MODULE
		$this->loadMigrationsFrom(__DIR__ . '/Modules/gallery/database/migrations');
		$this->loadViewsFrom(__DIR__ . '/Modules/gallery/resources/view', 'ikpanel-gallery');
		$this->loadRoutesFrom(__DIR__ . '/Modules/gallery/routes/web.php');
		$this->loadTranslationsFrom(__DIR__ . '/Modules/gallery/resources/lang', 'ikpanel-gallery');
		
		$this->publishes([
			__DIR__ . '/Modules/gallery/public/js' => public_path('ikpanel/modules/gallery/js')
		], 'ikpanel-gallery');
		
		// CALENDAR MODULE
		$this->loadMigrationsFrom(__DIR__ . '/Modules/calendar/database/migrations');
		$this->loadViewsFrom(__DIR__ . '/Modules/calendar/resources/view', 'ikpanel-calendar');
		$this->loadRoutesFrom(__DIR__ . '/Modules/calendar/routes/web.php');
		$this->loadTranslationsFrom(__DIR__ . '/Modules/calendar/resources/lang', 'ikpanel-calendar');
		
		$this->publishes([
			__DIR__ . '/Modules/calendar/public/js' => public_path('ikpanel/modules/calendar/js')
		], 'ikpanel-calendar');
		
		parent::boot();
	}
	
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
			require_once($filename);
		}
		
		App::bind('PanelException', function() {
			return new ExceptionReporting();
		});
	}
	
	public function map() {
		$this->mapWebRoutes();
	}
	
	protected function mapWebRoutes() {
		
		Route::middleware('web')
			->namespace("ikdev\ikpanel\app\Http\Controllers")
			->group(__DIR__ . '/routes/web.php');
		
		// Blog module
		Route::middleware('web')
			->namespace("ikdev\ikpanel\Modules\blog\app\Http\Controllers")
			->group(__DIR__ . '/Modules/blog/routes/web.php');
		
		// Gallery module
		Route::middleware('web')
			->namespace("ikdev\ikpanel\Modules\gallery\app\Http\Controllers")
			->group(__DIR__ . '/Modules/gallery/routes/web.php');
		
		// Calendar module
		Route::middleware('web')
			->namespace("ikdev\ikpanel\Modules\calendar\app\Http\Controllers")
			->group(__DIR__ . '/Modules/calendar/routes/web.php');
	}
}
