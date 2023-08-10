<?php

namespace App\HTTP\Model;

use App\System\Models\Model;

class BaseModel extends Model
{
    /**
     * connection to the database
     * no need to override
     */
    protected static $instance;
    /**
     * @var string
     * the name of the table that will be accessed from the controller
     */
    protected string $table = '';
    /**
     * @var string
     * the name of the primary key to manipulate in SQL queries
     */
    protected string $pk = '';
    /**
     * @var array
     * database SQL query validation rules
     */
    protected array $validationRules = [];
}