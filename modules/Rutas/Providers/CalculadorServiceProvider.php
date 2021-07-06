<?php
namespace Modules\Rutas\Providers;

use Modules\Rutas\Controllers\Calculador;
use Illuminate\Support\ServiceProvider;

class CalculadorServiceProvider extends ServiceProvider
{
    /**
     *
     * @return Calculador
     */
    public function register()
    {
        $this->app->bind(Calculador::class, function ($app) {
            return new Calculador();
        });
    }

    /**
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
