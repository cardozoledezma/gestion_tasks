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

        $query  = self::$connection->query($sqlReq);
        return $query->fetchAll();
    }

    public static function updateTask():bool {
        $sql = "UPDATE task SET done=:done WHERE id_task=:id_task;";
        $prepare = self::$connection->prepare($sql);
        $results = $prepare->execute(
            [
                'id_task' => intval($_REQUEST['id']),
                'done' => ($_REQUEST['checked']=="true") ? 1 : 0
            ]
        );
        return $results;
    }
    public static function insertTask():bool {
        $sql = "INSERT INTO task (description, color, priority, date_reminder, done, id_users) VALUES (:description, :color, :priority, :date_reminder, :done, :id_users)";

        $prepare = self::$connection->prepare($sql);
        $results =  $prepare->execute(
            [
                "description"   => $_REQUEST['nameTask'],
                "color"         => $_REQUEST['selectColor'],
                "priority"      => $_REQUEST['selectPriority'],
                "date_reminder" => $_REQUEST['inputDate'],
                "done"          => 0,
                "id_users"      => 0
                ]
            );
        return $results;
    }
    public static function insertTheme():bool {
        $results = false;
        $sql_count = "SELECT * FROM task;";
        $requete = self::$connection->prepare($sql_count);
        $requete->execute();
        $count = $requete->rowCount();

        $selectTheme = array_filter(explode("~", $_REQUEST['selectTheme']), fn($r) => $r != '');
        sort($selectTheme);

        foreach($selectTheme as $select){
            try{
                $SQL2 = "INSERT INTO contain (id_task, id_theme) VALUES (:id_task, :id_theme);";
                $requete = self::$connection->prepare($SQL2);
                $results = $requete->execute(
                    [
                        "id_task"       => $count,
                        "id_theme"      => $select
                    ]
                );
            }
            catch (Exception $e) { echo json_encode(["error" => $e->getMessage()]);exit; }
        }
        return $results;
    }

}

?>