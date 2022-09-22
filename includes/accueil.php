<?php


use App\Models\Task;
use App\Models\Theme;
use App\Views\View;
use App\Views\TaskView;

$tasks = new Task;
$themes = new Theme;
$taskview = new TaskView;

$results = $tasks->getAllTables();

$nextID = null;
$themeTask = [];
$color_use = 0;
$j = 0;

/** VARIABLES **/
$date = date("Y-m-d");

$listTH = array_map( fn($t) => ["id_task"=>$t['id_task'], "id_theme"=>$t['id_theme'], "theme_name"=>$t['theme_name']], $themes->getListThemes() );
$themes = array_map(fn($t) => ["name"=>$t['theme_name']], $themes->getThemes());

$filterTheme = "<select id='sort-theme' name='sort-theme'>
    <option selected readonly>Tri par thème</option>
    <option readonly></option>";

    foreach($themes as $index=>$theme){ $filterTheme .= "<option value='".($index+1)."'>".$theme['name']."</option>"; }

    $filterTheme .= "</select>";

$filters = $list = "
    <div class='sort_list'>
        ".$taskview->filterPriority()."
    </div>
<ul class='listTasks'>";

$list = $filters."<div class='title'>Liste des tâches en cours</div>";

foreach($results as $task){

    $themeTask = [];

    if (!$task['done'] && $task['id_task'] != $nextID){

        $list .= "<form merthod='GET' action='update.php?id=".$task['id_task']."' id='formAccueil".$task['id_task']."' name='formAccueil".$task['id_task']."' class='formAccueil'>";
        $list .= $j == 0 ? "<li class='cellList refs'><div>Description</div><div>Priority</div><div>Date_reminder</div><div>Thème</div><div>ToDo</div><div>Save</div></li>" : "";
        $list .= "  <li class='cellList' style='background-color: ".$task['color'].";'>";
        $list .= "      <div class='description'><input type='text' value='".$task['description']."' id='id-description".$task['id_task']."' name='id-description".$task['id_task']."' ></div>";
        $list .= "      <div class='priority'>";
        $list .="           <span>Priorité</span><select id='select-priority' name='select-priority'>";

        for($i=1;$i<=5;$i++){
            if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == $i) $list .= "              <option value='$i' selected>".$i."</option>";
            else $list .= "              <option value='".$i."' ".($task['priority'] == $i ? "selected" : "").">".$i."</option>";
        }

        $list .= "          </select>";
        $list .= "      </div>";
        $list .= "      <div class='date'>".$task['date_reminder']."</div>";
        $list .= "      <div class='theme '>";

        $i = 1;

        foreach($listTH as $th){
            $theme [] = "theme".$i;
            if($th['id_task'] == $task['id_task']) $themeTask[] = "<label for='theme".$task['id_task']."'>".$th['theme_name']."</label><input type='checkbox' id='theme".$i."' name='theme".$i."' value='".$th['id_theme']."' checked><br>";
            $i++;
        }

        $list .= implode(" ", $themeTask);
        $list .= "      </div>";
        $list .= "      <div class='div-checkbox'><span>Valider</span><input type='checkbox' value='".$task['id_task']."' id='id-checkbox".$task['id_task']."' name='id-checkbox".$task['id_task']."' class='id-checkbox' ".($task['done'] ? "checked" : "")."/></div>";
        $list .= "      <div class='div-description'><button class='btn-description' id='btn-description".$task['id_task']."' name='btn-description".$task['id_task']."'><i class='fa fa-floppy-o' aria-hidden='true'></i></button></div>";
        $list .= "  </li>";
        $list .= "</form>";
        $j++;
        $nextID = $task['id_task'];
    }
}

$list .= "</ul>";

echo $list;

?>