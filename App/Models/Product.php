<?php

namespace App\Models;
use PDO;
use FFI\Exception;

class Product extends Model{

    public function getAll():array {
        $query  = $this->connection->query("SELECT * FROM tasks ");
        return $query->fetchAll();
    }

    public function add(array $data):bool|id {
        /** $sql = "INSERT INTO tasks (1, 2, 3) VALUES (?, ?, ?)" */
    }
}

?>