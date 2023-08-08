<?php

namespace App\HTTP\Controller;

use App\System\Route\Route;
use App\System\View\View;

class PostController extends Controller
{
    public function index(): string
    {
        return View::view('post.index');
    }

    public function show($id): string
    {

        return View::view('post.show', compact('id'));
    }

    public function store()
    {
        Route::redirect('/PHP-routing/public/posts');
    }
}