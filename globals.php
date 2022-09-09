<?php

$color_use = 0;
$j = 0;
/** VARIABLES **/
$date = date("Y-m-d");
/*** DEFINE PAGE ***/
$dir = isset($_REQUEST['dir']) ? $_REQUEST['dir'] : 1;
/*** DATABASE ACCESS ***/
try {
    $dbOptions = [ PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC ];
    $dbCo = new PDO( 'mysql:host=localhost;dbname=list_task;charset=utf8', 'xloadx', 'r86bs9kp', $dbOptions);
}
catch (Exception $e) {
    die("Unable to connect to the database.".$e->getMessage());
}
/*** HOME PAGE REQUEST ONGOING TASKS ***/
$SQL = "SELECT * FROM task";
$SQL .= (isset($_REQUEST['sort'])) ? " ORDER BY priority" : "";
$requete = $dbCo->prepare($SQL);
$requete->execute();
/*** DATA OF DATABASE ***/
$tasks = array_map(fn($t) => ["id_task"=>$t['id_task'], "description"=>$t['description'], "color"=>$t['color'], "priority"=>$t['priority'], "date_reminder"=>$t['date_reminder'], "done"=>$t['done'], "id_users"=>$t['id_users']], $requete->fetchAll());

$color = [ "f7d9d9", "dad9f7", "e0f7d9", "f7f7d9", "f7e9d9", "eed9f7", "f7d9f6", "d9f7f7" ];

$sortPriority = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : '';

?>