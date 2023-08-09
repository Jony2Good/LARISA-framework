<?php

session_start();

require "../vendor/autoload.php";
require "../routes/web.php";


use App\System\App;

try {
    App::run();
} catch (\Exception $e) {
    echo $e->getMessage();
}
