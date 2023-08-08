<?php

namespace App\System;

use App\System\Route\Route;
use App\System\Route\RouteDispatcher;

class App
{
    public static function run()
    {
        foreach (Route::getRoutesGet() as $routeConfig) {
            $routeDispatcher = new RouteDispatcher($routeConfig);
            $routeDispatcher->process();

        }


    }

}