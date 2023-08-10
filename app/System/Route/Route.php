<?php

namespace App\System\Route;


class Route
{
    private static array $routesGet = [];
    private static array $routesPost = [];
    private static array $routesDelete = [];
    private static array $routesPut = [];

    /**
     * @return array
     */
    public static function getRoutesPut(): array
    {
        return self::$routesPut;
    }

    /**
     * @return array
     */
    public static function getRoutesDelete(): array
    {
        return self::$routesDelete;
    }

    /**
     * @return array
     */
    public static function getRoutesPost(): array
    {
        return self::$routesPost;
    }

    /**
     * @return array
     */
    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }

    /**
     * @param string $route
     * @param array $controller
     * @return RouteConfiguration
     */
    public static function get(string $route, array $controller): RouteConfiguration
    {
        return self::register($route, $controller, self::$routesGet);
    }

    /**
     * @param string $route
     * @param array $controller
     * @return RouteConfiguration
     */
    public static function post(string $route, array $controller): RouteConfiguration
    {
        return self::register($route, $controller, self::$routesPost);
    }

    /**
     * @param string $route
     * @param array $controller
     * @return RouteConfiguration
     */
      public static function delete(string $route, array $controller): RouteConfiguration
    {
        return self::register($route, $controller, self::$routesDelete);
    }

    /**
     * @param string $route
     * @param array $controller
     * @return RouteConfiguration
     */
    public static function put(string $route, array $controller): RouteConfiguration
    {
        return self::register($route, $controller, self::$routesPut);
    }

    /**
     * @param string $url
     * @return void
     */
    public static function redirect(string $url): void
    {
        header("Location: " . $url);
    }

    /**
     * @param string $route
     * @param array $controller
     * @param $arrayRoutes
     * @return RouteConfiguration
     */
    private static function register(string $route, array $controller, &$arrayRoutes): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        $arrayRoutes[] = $routeConfiguration;
        return $routeConfiguration;
    }
}