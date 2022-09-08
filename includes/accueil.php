<?php

include "globals.php";

$SQL = "SELECT *
FROM task;";

$requete = $dbCo->prepare($SQL);
$requete->execute();

$tasks = array_map(fn($t) => ["id_task"=>$t['id_task'], "description"=>$t['description'], "color"=>$t['color'], "priority"=>$t['priority'], "date_reminder"=>$t['date_reminder'], "done"=>$t['done'], "id_users"=>$t['id_users']], $requete->fetchAll());

// var_dump($tasks);

$list = "<ul>";

$color_use = 0;
foreach($tasks as $task){
    if((!$task['done'])){
        $list .= "<form merthod='GET' action='update.php?target=done&id=".$task['id_task']."'>";
        $list .= "  <li class='cellList' style='background-color: #".$color[$task['color']-1].";'>";
        $list .= "      <div class='description'>".$task['description']."</div>";
        $list .= "      <div class='priority'>";
        $list .="           <span>Priorité</span><select id='select-priority' name='select-priority'>";

        for($i=1;$i<=5;$i++){
            $list .= "              <option value='".$task['priority']."' ".($task['priority'] == $i ? "selected":"").">".$i."</option>";
        }

        $list .= "          </select>";
        $list .= "      </div>";
        $list .= "      <div class='date'>".$task['date_reminder']."</div>";
        $list .= "      <div class='div-checkbox'><span>Valider</span><input type='checkbox' value='".$task['id_task']."' id='id-checkbox'/></div>";
        $list .= "      <input type='hidden' value='".$task['id_users']."' id='hidden_value'>";
        $list .= "  </li>";
        $list .= "</form>";
    }

}

$list .= "</ul>";

echo $list;

?>
