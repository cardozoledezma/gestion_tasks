<?php

    include "../globals.php";

    $status = isset($_REQUEST['status'])    ? $_REQUEST['status']   : false;
    $checked= isset($_REQUEST['checked'])   ? $_REQUEST['checked']  : false;
    $value  = isset($_REQUEST['value'])     ? $_REQUEST['value']    : false;
    $id     = isset($_REQUEST['id'])        ? $_REQUEST['id']       : false;

    header('Content-Type: application/json');

    if(!$status || !$checked || !$value || !$id ) echo json_encode(["error" => ["message" => "Une erreur est survenue !!!"]]);
    else {
        if($status === "done"){
            $sql        = "UPDATE task SET done = $checked WHERE id_task = $id;";
            $request    = $dbCo->prepare($sql);
            $result     = $request->execute();

            $datas = [ "success" => ["message" => ($result) ? "success" : "error"] ];
            echo json_encode($datas);
        }
        if($status === "description"){
            $sql        = "UPDATE task SET description = '$value' WHERE id_task = $id;";
            $request    = $dbCo->prepare($sql);
            $result     = $request->execute();

            $datas = [ "success" => ["message" => ($result) ? "success" : "error"] ];
            echo json_encode($datas);
        }
    }

?>