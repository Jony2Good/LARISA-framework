<?php

namespace App\System\Route;


class Route
{
    private static array $routesGet = [];

    /**
     * @return array
     */
    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }


    public static function get(string $route, array $controller): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesGet[] = $routeConfiguration;
        return $routeConfiguration;
    }
}