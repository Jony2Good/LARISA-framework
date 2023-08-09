<?php

namespace App\HTTP\Controller;

use App\System\Route\Route;
use App\System\View\View;
use App\HTTP\Model\Post;
use System\Exceptions\ExcValidation;

class PostController extends Controller
{
    protected Post $model;

    public function __construct()
    {
        $this->model = Post::getInstance();
    }

    /**
     * @throws ExcValidation
     */
    public function index(): string
    {
        return View::view('post.index');
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
                'content' => $content
            ]);
        }
        Route::redirect('/PHP-routing/public/posts');
    }
}
