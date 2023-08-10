<?php

namespace App\HTTP\Model;

class Post extends BaseModel
{
    protected string $table = 'oop_articles_index';
    protected string $pk = 'id_article';

    protected array $validationRules = [
        'id_article' => ['locked'],
        'title' => ['not_empty'],
        'content' => ['not_empty'],
        'dt' => ['locked'],
    ];

}