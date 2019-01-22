<?php

namespace ikdev\ikpanel;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class IkpanelServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->publishes([
			__DIR__ . '/public'           => public_path('ikpanel/'),
			__DIR__ . '/resources/assets' => resource_path('assets/')
		], 'ikpanel');
		
		$this->publishes([
			__DIR__ . '/app/Http/Kernel.php' => app_path('Http/Kernel.php'),
		], 'ikpanel_kernel');
		
		$this->publishes([
			__DIR__ . '/config/ikpanel-config.php' => base_path('config/ikpanel-config.php')
		], 'ikpanel_config');
		
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
		
		// Calendar module
		Route::middleware('web')
			->namespace("ikdev\ikpanel\Modules\calendar\app\Http\Controllers")
			->group(__DIR__ . '/Modules/calendar/routes/web.php');
	}
}
