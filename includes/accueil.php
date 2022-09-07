<?php

include "globals.php";

$SQL = "SELECT *
FROM task;";

$requete = $dbCo->prepare($SQL);
$requete->execute();

$tasks = array_map(fn($t) => [$t['description'], $t['color'], $t['priority'], $t['date_reminder'], $t['done'], $t['id_users']], $requete->fetchAll());

// var_dump($tasks);

$list = "<ul>";

foreach($tasks as $task){
    $list .= "<li>";
    foreach($task as $t){
        $list .= "<div class='cellList'>".$t."</div>";
    }
    $list .= "</li>";
}

$list .= "</ul>";

echo $list;

?>