<?php

    include "./../globals.php";

    $boolResquest = false;
    $SQL = "INSERT INTO task (description, color, priority, date_reminder, done, id_users) VALUES (:description, :color, :priority, :date_reminder, :done, :id_users)";
    $requete = $dbCo->prepare($SQL);
    $test1 = $requete->execute(
        [
            "description"   => $_REQUEST['nameTask'],
            "color"         => $_REQUEST['selectColor'],
            "priority"      => $_REQUEST['selectPriority'],
            "date_reminder" => $_REQUEST['inputDate'],
            "done"          => 0,
            "id_users"      => 0
            ]
    );

    if($test1){
        $sql_count = "SELECT * FROM task;";
        $requete = $dbCo->prepare($sql_count);
        $requete->execute();
        $count = $requete->rowCount()+1;

        $selectTheme = array_filter(explode("~", $_REQUEST['selectTheme']), fn($r) => $r != '');
        sort($selectTheme);

        foreach($selectTheme as $select){
            $SQL2 = "INSERT INTO contain (id_task, id_theme) VALUES (:id_task, :id_theme);";
            $requete = $dbCo->prepare($SQL2);
            $boolResquest = $requete->execute(
                [
                    "id_task"       => $count,
                    "id_theme"      => $select
                    ]
                );
            }
        }

        header("Content-Type: application/json charset=UTF-8");
        echo json_encode(["success" => $boolResquest , "REQUEST" => $_REQUEST['selectTheme'], "THEME" => $selectTheme, "COUNT" => $count]);

?>