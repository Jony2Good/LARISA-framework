<?php

namespace App\System\View;

class View
{
    private static string $path;
    private static ?array $data;
    protected Content $view;

    public function __construct()
    {
        $this->view = Content::getInstance();
    }

    public function view(string $str, array $data = []): string
    {
        self::$data = $data;
        $path = str_replace('app\System\View', 'resources\views', __DIR__);
        self::$path = $path . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $str) . '.twig';
        return self::getContent();
    }

    private static function getContent(): false|string
    {
        extract(self::$data);
        ob_start();
        require self::$path;
        $html = ob_get_contents();
        ob_get_clean();
        return $html;
    }

}