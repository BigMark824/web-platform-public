<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class InsensitiveRouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        parent::boot();
        Route::pattern('slug', '[a-z0-9-]+');
    }
    protected function mapApiRoutes()

    {

        Route::prefix('api')

             ->middleware('api')

             ->namespace($this->namespace)

             ->group(base_path('routes/api.php'));

    }

}