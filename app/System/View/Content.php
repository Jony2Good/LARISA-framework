<?php

namespace App\System\View;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Content
{
    protected Environment $twig;
    protected array $global = [];
    public static $instance;

    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function addGlobalVar(string $name, mixed $value): void
    {
        $this->global[$name] = $value;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function render($pathToTemplate, $vars = []): string
    {
        var_dump($this->twig->render($pathToTemplate, $vars + $this->global));
        return $this->twig->render($pathToTemplate, $vars + $this->global);
    }

    protected function __construct()
    {
        $loader = new FilesystemLoader("../resources");
        $this->twig = new Environment($loader, [
            'cache' => 'cache/twig',
            'auto_reload' => true,
            'autoescape' => false
        ]);
    }

}