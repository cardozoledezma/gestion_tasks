<?php

    include "/globals.php";

    echo json_encode(["success" => ["POST" => $_POST, "REQUEST" => $_REQUEST] ]);
    $sql_count = "SELECT COUNT(*) FROM task;";
    $requete = $dbCo->prepare($sql_count);
    $count = $requete->rowCount();


    $SQL = "INSERT INTO task JOIN contain (description, color, priority, date_reminder, done, id_users, id_theme, id_task) 
    VALUES (:description, :color, :priority, :date_reminder, :done, :id_users, :id_theme, :id_task);";
    $requete = $dbCo->prepare($SQL);

    $requete->execute([
        "description"   => $_REQUEST['nameTask'],
        "color"         => $_REQUEST['selectColor'],
        "priority"      => $_REQUEST['selectPriority'],
        "date_reminder" => $_REQUEST['datePicker'],
        "done"          => 0,
        "id_users"      => 0,
        "id_theme"      => $_REQUEST['selectTheme'],
        "id_task"       => $count+1
    ]);

    

?>