<?php

namespace App\System\Models;

use App\System\Database\ConnectionDb;
use App\System\Database\QuerySelect;
use App\System\Database\SelectBuilder;
use App\System\Validator\Validator;
use System\Exceptions\ExcValidation;

abstract class Model
{
    protected static $instance;

    protected ConnectionDb $db;
    protected string $table;
    protected string $pk;
    protected array $validationRules;

    protected Validator $validator;

    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function __construct()
    {
        $this->db = ConnectionDb::getInstance();
        $this->validator = new Validator($this->validationRules);
    }

    public function all(): array
    {
        return $this->selector()->get();
    }

    public function get(int $id): ?array
    {
        //формирует строку "Where articles_id = :pk" и для команды execute(['pk' => $id])
        $res = $this->selector()->where("{$this->pk} = :pk", ['pk' => $id])->get();
        return $res[0] ?? null;
    }

    public function selector(): QuerySelect
    {
        $builder = new SelectBuilder($this->table);
        return new QuerySelect($this->db, $builder);
    }

    public function insert(array $fields): int
    {
        $isValid = $this->validator->run($fields);

        if (!$isValid) {
            throw new ExcValidation();
        }
        $names = [];
        $masks = [];
        foreach ($fields as $field => $val) {
            $names[] = $field;
            $masks[] = ":$field";
        }
        $namesStr = implode(', ', $names);
        $masksStr = implode(', ', $masks);

        $query = "INSERT INTO {$this->table} ($namesStr) VALUES ($masksStr)";
        $this->db->query($query, $fields);
        return $this->db->lastInsertId();//ВОЗВРАЩАЕТ ID ДЛЯ УНИВЕРСАЛЬНОСТИ
    }

    public function update(int $id, array $fields): bool
    {
        //валидация исключение
    }

    public function delete(int $id): bool
    {

    }

}