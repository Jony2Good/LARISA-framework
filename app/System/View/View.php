<?php

namespace App\System\View;


use App\System\Route\RouteConfiguration;

class View
{
    private static string $path;
    private static ?array $data;

    public static function view(string $str, array $data = []): string
    {
        self::$data = $data;
        $path = str_replace('app\System\View', 'resources\views', __DIR__);
        self::$path = $path . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $str) . '.php';
        return self::getContent();
    }

    private static function getContent()
    {
        extract(self::$data);
        ob_start();
        include self::$path;
        $html = ob_get_contents();
        ob_get_clean();
        return $html;
    }

}