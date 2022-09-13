<?php

$nextID = null;
$themeTask = [];
$color_use = 0;
$j = 0;
$where = [];

$sortPriority   = isset($_REQUEST['sort'])  ?  $where[] = " priority=".$_REQUEST['sort']    : false;
$sortTheme      = isset($_REQUEST['theme']) ?  $where[] = " id_theme=".$_REQUEST['theme']   : false;

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
    JOIN contain c USING (id_task)
    JOIN theme th USING (id_theme) ";
$SQL .= (isset($_REQUEST['sort']) || isset($_REQUEST['theme'])) ? " WHERE " : " ";
$issetWhere = (isset($_REQUEST['sort']) || isset($_REQUEST['theme'])) ? $where[0] : "";
$SQL .= (sizeof($where) > 1) ? implode(' AND ',  $where) : $issetWhere;
$requete = $dbCo->prepare($SQL);
$requete->execute();

/*** REQUEST THEMES ***/
$SQL2 = "SELECT * FROM theme";
$requete2 = $dbCo->prepare($SQL2);
$requete2->execute();

/*** REQUEST LIST THEMES BY TASKS ***/
$SQL3 = "SELECT c.id_task, c.id_theme, th.theme_name
FROM task t
    JOIN contain c USING (id_task)
    JOIN theme th USING (id_theme)
WHERE t.id_task = c.id_task AND c.id_theme = th.id_theme
ORDER BY t.id_task";
$requete3 = $dbCo->prepare($SQL3);
$requete3->execute();
/* LISTE THEMES */
$listTH = array_map( fn($t) => ["id_task"=>$t['id_task'], "id_theme"=>$t['id_theme'], "theme_name"=>$t['theme_name']], $requete3->fetchAll() );

/* TASKS */
$tasks = array_map(fn($t) =>
    ["id_task"=>$t['id_task'], "description"=>$t['description'], "color"=>$t['color'], "priority"=>$t['priority'], "date_reminder"=>$t['date_reminder'], "done"=>$t['done'], "id_users"=>$t['id_users'], 
    "theme"=>["id_theme"=>$t['id_theme'], "theme_name"=>$t['theme_name']]],
    $requete->fetchAll());
/* THEMES */
$themes = array_map(fn($t) => ["name"=>$t['theme_name']], $requete2->fetchAll());

$colors = [ "f7d9d9", "dad9f7", "e0f7d9", "e6f2b6", "f49f9f", "f7ba74", "9ef5db", "a4b7d7" ];

$filterPriority = "<select id='sort-priority' name='sort-priority'>
    <option selected readonly>Tri par priorité</option>
    <option readonly></option>";

    for($i=1;$i<=5;$i++){
        $filterPriority .= "<option value='$i'>$i</option>";
    }

$filterPriority .= "</select>";

$filterTheme = "<select id='sort-theme' name='sort-theme'>
    <option selected readonly>Tri par thème</option>
    <option readonly></option>";

    foreach($themes as $index=>$theme){ $filterTheme .= "<option value='".($index+1)."'>".$theme['name']."</option>"; }

    $filterTheme .= "</select>";

$filters = $list = "
    <div class='sort_list'>
        $filterPriority $filterTheme
    </div>
<ul class='listTasks'>";


?>