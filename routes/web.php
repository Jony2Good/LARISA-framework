<?php


use App\System\Route\Route;
use App\HTTP\Controller\PostController;


//корректировать пути
Route::get('/PHP-routing/public/posts', [PostController::class, 'index'])->name('post.index')->middleware('auth');
Route::get('/PHP-routing/public/posts/{id}', [PostController::class, 'show'])->name('post.show')->middleware('auth');
Route::post('/PHP-routing/public/posts', [PostController::class, 'store'])->name('post.store')->middleware('auth');


