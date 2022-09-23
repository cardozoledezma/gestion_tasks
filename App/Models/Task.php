<?php

namespace App\Models;

use PDO;
use FFI\Exception;

class Task extends Model{

    public string $sql = "";

    public function getAll():array {
        $query  = self::$connection->query("SELECT * FROM task");
        return $query->fetchAll();
    }

    public function getPriority():string {
        return isset($_REQUEST['sort'])  ?  " t.priority=".$_REQUEST['sort']    : false;
    }

    public function getSortTheme():string {
        return isset($_REQUEST['theme']) ?  " c.id_theme=".$_REQUEST['theme']   : false;
    }

    public function getSortTables():array {
        $where = [];
        if(self::getPriority() != '') $where[] = self::getPriority();
        if(self::getSortTheme() != '') $where[] = self::getSortTheme();

        $sqlReq = "SELECT *
        FROM task t
            JOIN contain c USING (id_task)
            JOIN theme th USING (id_theme) ";
        $sqlReq .= (isset($_REQUEST['sort']) || isset($_REQUEST['theme'])) ? " WHERE " : " ";
        $issetWhere = (isset($_REQUEST['sort']) || isset($_REQUEST['theme'])) ? $where[0] : "";
        $sqlReq .= (sizeof($where) >= 2) ? implode(' AND ',  $where) : $issetWhere;

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