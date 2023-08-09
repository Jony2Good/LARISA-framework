<?php

namespace App\System\Database;

use PDO;
use PDOStatement;

class ConnectionDb
{
    public static $instance;
    public PDO $db;

    /**
     * @return mixed
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=message', 'root', "",
            [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
    }

    /**
     * @param string $query
     * @param array $params
     * @return array|null
     */
    public function select(string $query, array $params = []): ?array
    {
        return $this->query($query, $params)->fetchAll();
    }

    /**
     * @param string $query
     * @param array $params
     * @return PDOStatement|false
     */
    public function query(string $query, array $params = []): PDOStatement|false
    {
        $query = $this->db->prepare($query);
        $query->execute($params);
        return $query;
    }

    public function lastInsertId(): int
    {
        return (int)$this->db->lastInsertId();
    }

}
