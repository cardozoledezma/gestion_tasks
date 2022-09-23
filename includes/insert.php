<?php

    require_once "../App/Models/Model.php";
    require_once "../App/Models/Task.php";

    use App\Models\Task as TaskModel;

    $tasks = new TaskModel;

    $results = $tasks->insertTask();

    if($results){
        $results = $tasks->insertTheme();
    }

    header('Content-Type: application/json charset=UTF-8');
    $datas = [ "success" => ["message" => ($results) ? "success" : "error"] ];
    echo json_encode($datas);


?>