<?php

namespace Ikdev\Ikpanel;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class IkpanelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
        	__DIR__.'/public' => public_path('ikpanel/')
        ], 'ikpanel');
        
        $this->loadRoutesFrom(__DIR__ .'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/view', 'ikpanel');

        parent::boot();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    public function map() {
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes() {

        Route::middleware('web')
            ->namespace("Ikdev\Ikpanel\app\Http\Controllers")
            ->group(base_path('packages/ikdev/ikpanel/src/routes/web.php'));
    }
}
