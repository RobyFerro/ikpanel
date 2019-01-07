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
			__DIR__ . '/resources/assets' => resource_path('assets/'),
			__DIR__ . '/node'             => base_path('/')
		], 'ikpanel');
		
		$this->publishes([
			__DIR__ . '/app/Http/Kernel.php' => app_path('Http/Kernel.php'),
		], 'ikpanel_kernel');
		
		$this->publishes([
			__DIR__ . '/config/admin-panel.php' => base_path('config/ikpanel-panel.php')
		], 'ikpanel_config');
		
		$this->loadRoutesFrom(__DIR__ . '/routes/web.php');
		$this->loadMigrationsFrom(__DIR__ . '/database/migrations');
		$this->loadViewsFrom(__DIR__ . '/resources/view', 'ikpanel');
		
		
		// BLOG MODULE
		$this->loadMigrationsFrom(__DIR__ . '/Modules/blog/database/migrations');
		
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
	}
}
