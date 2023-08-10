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

    /**
     * @return static
     */
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

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->selector()->get();
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function get(int $id): ?array
    {
        //формирует строку "Where articles_id = :pk" и для команды execute(['pk' => $id])
        $res = $this->selector()->where("{$this->pk} = :pk", ['pk' => $id])->get();
        return $res[0] ?? null;
    }

    /**
     * @return QuerySelect
     */
    public function selector(): QuerySelect
    {
        $builder = new SelectBuilder($this->table);
        return new QuerySelect($this->db, $builder);
    }

    /**
     * @param array $fields
     * @return int
     * @throws ExcValidation
     */
    public function insert(array $fields): int
    {
        $str = $this->getFields($fields);
        $query = "INSERT INTO {$this->table} ({$str[0]}) VALUES ({$str[1]})";
        $this->db->query($query, $fields);
        return $this->db->lastInsertId();
    }

    /**
     * @param int $id
     * @param array $fields
     * @return bool
     * @throws ExcValidation
     */
    public function update(int $id, array $fields): bool
    {
        $checkId = $this->get($id);
        if (isset($checkId)) {
            $str = $this->updateFields($fields);
            $query = "UPDATE {$this->table} SET {$str} WHERE {$this->pk} = :{$this->pk}";
            $this->db->query($query, $fields + [$this->pk => $id]);
            return true;
        }
        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $checkId = $this->get($id);
        if (isset($checkId)) {
            $query = "DELETE FROM {$this->table} WHERE {$this->pk} = :{$this->pk}";
            $this->db->query($query, [$this->pk => $id]);
            return true;
        }
        return false;
    }

    /**
     * @param array $fields
     * @return array
     * @throws ExcValidation
     */
    private function getFields(array $fields): array
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

        return [$namesStr, $masksStr];
    }

    private function updateFields(array $fields)
    {
        $isValid = $this->validator->run($fields);
        if (!$isValid) {
            throw new ExcValidation();
        }
        $pairs = [];
        foreach ($fields as $field => $val) {
            $pairs[] = "$field=:$field";
         }
        return implode(', ', $pairs);
    }
}