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
/*** REQUEST ONGOING TASKS ***/
$SQL = "SELECT *
FROM task t
    JOIN contain USING (id_task)
    JOIN theme USING (id_theme)";
$SQL .= (isset($_REQUEST['sort'])) ? " ORDER BY t.priority" : "";
$requete = $dbCo->prepare($SQL);
$requete->execute();

/*** REQUEST ONGOING TASKS ***/
$SQL2 = "SELECT * FROM theme";
$requete2 = $dbCo->prepare($SQL2);
$requete2->execute();

/* TASKS */
$tasks = array_map(fn($t) => ["id_task"=>$t['id_task'], "description"=>$t['description'], "color"=>$t['color'], "priority"=>$t['priority'], "date_reminder"=>$t['date_reminder'], "done"=>$t['done'], "id_users"=>$t['id_users'], "theme"=>["id_theme"=>$t['id_theme'], "theme_name"=>$t['theme_name']]], $requete->fetchAll());
/* THEMES */
$themes = array_map(fn($t) => ["name"=>$t['theme_name']], $requete2->fetchAll());

$color = [ "f7d9d9", "dad9f7", "e0f7d9", "f7f7d9", "f7e9d9", "eed9f7", "f7d9f6", "d9f7f7" ];

$sortPriority = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : '';
$sortTheme = isset($_REQUEST['theme']) ? $_REQUEST['theme'] : '';

$filterPriority = "<select id='sort-priority' name='sort-priority'>
    <option selected readonly>Tri par priorité</option>
    <option readonly></option>
    <option value='priority'>Priorité</option>
</select>";

$filterTheme = "<select id='sort-theme' name='sort-theme'>
    <option selected readonly>Tri pa thème</option>
    <option readonly></option>";

    foreach($themes as $index=>$theme){ $filterTheme .= "<option value='".($index+1)."'>".$theme['name']."</option>"; }

    $filterTheme .= "</select>";

$filters = $list = "
<div class='title'>Liste des tâches en cours</div>
    <div class='sort_list'>
        $filterPriority $filterTheme
    </div>
<ul class='listTasks'>";


?>