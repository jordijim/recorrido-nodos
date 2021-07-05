<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Rutas\Controllers\Calculador;

class RouteController extends Controller
{
    protected $calculador;

    public function __construct(Calculador $calculador)
    {
        $this->calculador = $calculador;
    }

    /**
     * @param String $origin
     * @param String $destination
     */
    public function index(String $origin, String $destination) :void
    {
        $this->calculador->inicio($origin, $destination);
    }

}
