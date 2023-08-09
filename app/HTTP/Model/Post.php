<?php

namespace App\HTTP\Model;

use App\System\Models\Model;

class Post extends Model
{
    protected static $instance;
    protected string $table = 'oop_articles_index';
    protected string $pk = 'id_article';

    protected array $validationRules = [
        'id_article' => ['locked'],
        'title' => ['not_empty'],
        'content' => ['not_empty'],
        'dt' => ['locked'],
    ];

}