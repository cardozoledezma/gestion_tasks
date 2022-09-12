<?php

$list = $filters;

foreach($tasks as $task){
    $themeTask = [];
    if($task['id_task'] != $nextID){
        $list .= "<form merthod='GET' action='update.php?id=".$task['id_task']."' id='formAccueil' name='formAccueil'>";
        $list .= $j == 0 ? "<li class='cellList refs'><div>Description</div><div>Priority</div><div>Date_reminder</div><div>Thème</div><div>ToDo</div><div>Save</div></li>" : "";
        $list .= "  <li class='cellList' style='background-color: #".$color[$task['color']-1].";'>";
        $list .= "      <div class='description'><input type='text' value='".$task['description']."' id='id-description".$task['id_task']."' name='id-description".$task['id_task']."' ></div>";
        $list .= "      <div class='priority'>";
        $list .="           <span>Priorité</span><select id='select-priority' name='select-priority'>";

        for($i=1;$i<=5;$i++){
            $list .= "              <option value='".$task['priority']."' ".($task['priority'] == $i ? "selected":"").">".$i."</option>";
        }

        $list .= "          </select>";
        $list .= "      </div>";
        $list .= "      <div class='date'>".$task['date_reminder']."</div>";
        $list .= "      <div class='theme'>";

        foreach($listTH as $th){
            if($th['id_task'] == $task['id_task']) $themeTask[] = "<label for='theme".$task['id_task']."'>".$th['theme_name']."</label><input type='checkbox' id='theme".$task['id_task']."' name='theme".$task['id_task']."' value='".$th['theme_name']."' checked> <br>";
        }

        $list .= implode(" ", $themeTask);
        $list .= "      </div>";
        $list .= "      <div class='div-checkbox'><span>Valider</span><input type='checkbox' value='".$task['id_task']."' id='id-checkbox".$task['id_task']."' name='id-checkbox".$task['id_task']."' class='id-checkbox' ".($task['done'] ? "checked" : "")."/></div>";
        $list .= "      <div class='div-description'><input type='button' value='Save changes' class='btn-description' id='btn-description".$task['id_task']."' name='btn-description".$task['id_task']."' /></div>";
        $list .= "  </li>";
        $list .= "</form>";
        $j++;
        $nextID = $task['id_task'];
    }
}
$list .= "</ul>";

echo $list;

?>