<?php

namespace App\Models;

use PDO;
use FFI\Exception;

class Task extends Model{

    public string $sql = "";

    public function getAll():array {
        $query  = self::$connection->query("SELECT * FROM task");
        var_dump($query);
        return $query->fetchAll();
    }

    public function getAllUndone():array {
        $query  = self::$connection->query("SELECT * FROM task WHERE done = 0;");
        var_dump($query);
        return $query->fetchAll();
    }

    public function getAllDone():array {
        $query  = self::$connection->query("SELECT * FROM task WHERE done = 1;");
        var_dump($query);
        return $query->fetchAll();
    }

    public function getPriority():string {
        return isset($_REQUEST['sort'])  ?  $_REQUEST['sort'] : false;
    }

    public function getSortTheme():string {
        return isset($_REQUEST['theme']) ?  $_REQUEST['theme'] : false;
    }

    public function getSortTables():array {

        $sqlReq = "SELECT *
        FROM task t
            JOIN contain c USING (id_task)
            JOIN theme th USING (id_theme)
        WHERE done = 0 ";
        $sqlReq .= isset($_REQUEST['sort'])     ? " AND t.priority = ".self::getPriority() : "";
        $sqlReq .= isset($_REQUEST['theme'])    ? " AND c.id_theme = ".self::getSortTheme() : "";

        self::setSql($sqlReq);
        var_dump($sqlReq);

        $query  = self::$connection->query(self::getSql());
        return $query->fetchAll();
    }

    public function updateTable(int $id, int $checked):bool {
        self::setSql("UPDATE task SET done = :done WHERE id_task = :id_task;");

        $prepare = self::$connection->prepare(self::getSql());
        $result = $prepare->execute(
            [
                'id_task' => $id,
                'done' => $checked
            ]
        );
        return $result;
    }

}

?>