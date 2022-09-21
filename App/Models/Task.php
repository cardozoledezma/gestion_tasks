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

    public function getAllTables():array {
        $where = [];

        $sortPriority   = isset($_REQUEST['sort'])  ?  $where[] = " t.priority=".$_REQUEST['sort']    : false;
        $sortTheme      = isset($_REQUEST['theme']) ?  $where[] = " c.id_theme=".$_REQUEST['theme']   : false;

        $sqlReq = "SELECT *
        FROM task t
            JOIN contain c USING (id_task)
            JOIN theme th USING (id_theme) ";
        $sqlReq .= (isset($_REQUEST['sort']) || isset($_REQUEST['theme'])) ? " WHERE " : " ";
        $issetWhere = (isset($_REQUEST['sort']) || isset($_REQUEST['theme'])) ? $where[0] : "";
        $sqlReq .= (sizeof($where) > 1) ? implode(' AND ',  $where) : $issetWhere;

        self::setSql($sqlReq);

        $query  = self::$connection->query(self::getSql());
        return $query->fetchAll();
    }

}

?>