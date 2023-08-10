<?php

namespace App\HTTP\Controller;

use App\System\View\View;

class BaseController
{
    protected View $content;
    /**
     * protected <class name where table parameters are set> $model;
     */
     /**
     * --connection to the database--
     */
     public function __construct()
     {
      //$this->model = <class name>::getInstance();
         $this->content = new View();
     }



    /**
     * @return string
     */
    public function main(): string
    {
        return $this->content->view('main.main');
    }



}