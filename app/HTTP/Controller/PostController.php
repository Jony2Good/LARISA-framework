<?php

namespace App\HTTP\Controller;

use App\System\Route\Route;
use App\System\View\View;
use App\HTTP\Model\Post;
use System\Exceptions\ExcValidation;

class PostController extends BaseController
{
    protected Post $model;

    public function __construct()
    {
        $this->model = Post::getInstance();
    }

    /**
     * @throws ExcValidation
     */
    public function main(): string
    {
       return View::view('main.main');
    }

    public function show($id): string
    {
        return View::view('post.show', compact('id'));
    }

    /**
     * @throws ExcValidation
     */
    public function store()
    {
        $title = $_POST['title'] ?? "";
        $content = $_POST['content'] ?? "";

        if (empty($title) && empty($content)) {
            echo "Error data";
        } else {
            $_SESSION['title'] = $title;
            $_SESSION['content'] = $content;
            $this->model->insert([
                'title' => $title,
                'content' => $content,
            ]);
        }
        Route::redirect('/PHP-routing/public/posts');
    }

    public function remove($id)
    {
        var_dump($this->model->delete($id));

    }

    public function change()
    {
      $obj = $this->getJson();
      $this->model->update((int)$obj['id'], ['title' => $obj['title'], 'content' => $obj['content']]);
    }

    /**
    * @throws \Exception
     */
    private function getJson()
    {
        $json = file_get_contents('php://input');
        if (!$json) {
           die();
        }
        $obj = json_decode($json, true);
        if (!isset($obj)) {
            throw new \Exception('Bad JSON');
        }
       return $obj;
    }
}
