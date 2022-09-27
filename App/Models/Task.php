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

    public function getAllUndone():array {
        $query  = self::$connection->query("SELECT * FROM task WHERE done = 0;");
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

<<<<<<< HEAD
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
=======
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
        $results = false;
        try{
            var_dump($_POST);
            $sql = "INSERT INTO task (description, color, priority, date_reminder, done, id_users) VALUES (:description, :color, :priority, :date_reminder, :done, :id_users)";
            $prepare = self::$connection->prepare($sql);
            $results =  $prepare->execute(
                [
                    "description"   => $_POST['nameTask'],
                    "color"         => $_POST['selectColor'],
                    "priority"      => $_POST['selectPriority'],
                    "date_reminder" => $_POST['inputDate'],
                    "done"          => 0,
                    "id_users"      => 0
                ]
            );
        }
        catch (Exception $e) { echo json_encode(["error" => $e->getMessage()]);exit; }

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
    public function createConnection(){
        // var_dump($_REQUEST, $_SESSION, $_POST);
        try{
            $sql = "SELECT user_name, password FROM users WHERE user_name = :user_name AND password = :password;";
            $requete = self::$connection->prepare($sql);
            $requete->execute([
                "user_name" => $_POST['logUser'],
                "password"  => $_POST['passUser']
            ]);

            return $requete->fetchAll();
        }
        catch (Exception $e) { echo  $e->getMessage(); }
>>>>>>> 6c3bb4b8d99da435572cc979e91136fec9eff0c3

    }

}

?>