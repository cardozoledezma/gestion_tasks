<?php
    
    namespace App\Models;

    use App\Models\Task;

    $tasks = new Task;

    $status = isset($_REQUEST['status'])    ? $_REQUEST['status']   : false;
    $checked= isset($_REQUEST['checked'])   ? $_REQUEST['checked']  : false;
    $value  = isset($_REQUEST['value'])     ? $_REQUEST['value']    : false;
    $id     = isset($_REQUEST['id'])        ? $_REQUEST['id']       : false;

    header('Content-Type: application/json');

    if(!$id) echo json_encode(["error" => ["message" => "Une erreur est survenue !!!"]]);
    else {
        if($status === "done"){
            $sql        = "UPDATE task SET done = $checked WHERE id_task = $id;";
            $request    = $dbCo->prepare($sql);
            $return     = $request->execute();

            $data = [ "success" => ["message" => ($return) ? "success" : "error"] ];
            echo json_encode($data);
        }
        if($status === "description"){
            $sql        = "UPDATE task SET description = '$value' WHERE id_task = $id;";
            $request    = $dbCo->prepare($sql);
            $return     = $request->execute();

            $data = [ "success" => ["message" => ($return) ? "success" : "error"] ];
            echo json_encode($data);
        }
    }

?>