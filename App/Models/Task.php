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

    public static function insertTask():bool {
        new Task;
        $sqlReq = "INSERT INTO task (description, color, priority, date_reminder, done, id_users) VALUES (:description, :color, :priority, :date_reminder, :done, :id_users)";
        $prepare = self::$connection->prepare($sqlReq);
        $result = $prepare->execute(
            [
                "description"   => strip_tags($_REQUEST['nameTask']),
                "color"         => strip_tags($_REQUEST['selectColor']),
                "priority"      => strip_tags($_REQUEST['selectPriority']),
                "date_reminder" => strip_tags($_REQUEST['inputDate']),
                "done"          => 0,
                "id_users"      => 0
                ]
            );

            header("Content-Type: application/json charset=UTF-8");

            if($result){
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
                    $result = $requete->execute(
                        [
                            "id_task"       => strip_tags($count),
                            "id_theme"     => strip_tags($select)
                            ]
                        );
                    }
                catch (Exception $e) { echo json_encode(["error" => $e->getMessage()]);exit; }
            }
        }

        return $result;
    }

    public static function updateTask():void {
        new Task;

        $status = isset($_REQUEST['status'])    ? $_REQUEST['status']   : false;
        $checked= isset($_REQUEST['checked'])   ? $_REQUEST['checked']  : false;
        $value  = isset($_REQUEST['value'])     ? $_REQUEST['value']    : false;
        $id     = isset($_REQUEST['id'])        ? $_REQUEST['id']       : false;

        header("Content-Type: application/json charset=UTF-8");

        if(!$id) echo json_encode(["error" => ["message" => "Une erreur est survenue !!!"]]);
        else {
            if($status === "done"){
                $sql        = "UPDATE task SET done = $checked WHERE id_task = $id;";
                $request    = self::$connection->prepare($sql);
                $result     = $request->execute();

                $data = [ "success" => ["message" => $result] ];
                echo json_encode($data);
            }
            if($status === "description"){
                $sql        = "UPDATE task SET description = '$value' WHERE id_task = $id;";
                $request    = self::$connection->prepare($sql);
                $result     = $request->execute();

                $data = [ "success" => ["message" => $result] ];
                echo json_encode($data);
            }
        }

    }

}

?>