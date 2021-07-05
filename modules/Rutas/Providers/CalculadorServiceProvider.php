<?php
namespace Modules\Rutas\Providers;

use Modules\Rutas\Controllers\Calculador;
use Illuminate\Support\ServiceProvider;

class CalculadorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return Calculador
     */
    public function register()
    {
        $this->app->bind('Calculador', function ($app) {
            return new Calculador();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
