<?php

use App\HTTP\Controller\BaseController;
use App\System\Route\Route;



Route::get('/PHP-routing/public/posts', [BaseController::class, 'main'])->name('main.main');





