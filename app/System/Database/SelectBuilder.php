<?php

namespace App\System\Database;

use Exception;

class SelectBuilder
{
    public string $table;

    protected array $fields = ['*'];
    protected array $addons = [
        'join' => null,
        'where' => null,
        'group_by' => null,
        'having' => null,
        'order_by' => null,
        'limit' => null
    ];

    /**
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function fields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param string $where
     * @return $this
     */
    public function addWhere(string $where)
    {
        $this->addons['where'] .= ' ' . $where; //'WHERE $where"
        return $this;
    }

    public function __toString()
    {
        $activeCommands = [];
        foreach ($this->addons as $command => $setting) {
            if ($setting !== null) {
                $sqlKey = str_replace('_', ' ', strtoupper($command));//убирает подчеркивание из значений ключей
                $activeCommands[] = "$sqlKey $setting"; //в массив приходит ORDER BY и значение
            }
        }

        $fields = implode(', ', $this->fields);//объединение массива с SQL полями в строку, разделенную запятой
        $addon = implode(' ', $activeCommands);//объединение массива SQL команда + значение в строку
        return trim("SELECT {$fields} FROM {$this->table} {$addon}");
    }

    /**
     * @param string $name
     * @param array $args
     * @return $this
     * @throws Exception
     */
    public function __call(string $name, array $args) //магический метод, позволяющий вызывать несуществующие методы (SQL инструкции),
        // которые проверяются в массиве addons и если есть совпадение метода и ключа в массиве, то ключу присваивается значение
    {
        if (!array_key_exists($name, $this->addons)) {
            throw new Exception('sql error unknown');
        }
        $this->addons[$name] = $args[0];
        return $this;
    }

}