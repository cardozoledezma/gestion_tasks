<?php

$SQL = "SELECT * FROM task";
$SQL .= (isset($_REQUEST['sort'])) ? " ORDER BY priority" : "";

$requete = $dbCo->prepare($SQL);
$requete->execute();

$tasks = array_map(fn($t) => ["id_task"=>$t['id_task'], "description"=>$t['description'], "color"=>$t['color'], "priority"=>$t['priority'], "date_reminder"=>$t['date_reminder'], "done"=>$t['done'], "id_users"=>$t['id_users']], $requete->fetchAll());

$list = "
<div class='sort_list'>
    <select id='sort-priority' name='sort-priority'>
        <option selected readonly>Tri</option>
        <option readonly></option>
        <option value='priority'>Trier par priorité</option>
    </select>
</div>
<ul>";

// var_dump($_REQUEST);
$color_use = 0;
foreach($tasks as $task){
    if((!$task['done'])){
        $list .= "<form merthod='GET' action='update.php?target=done&id=".$task['id_task']."'>";
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
        $list .= "      <div class='div-checkbox'><span>Valider</span><input type='checkbox' value='".$task['id_task']."' id='id-checkbox".$task['id_task']."' name='id-checkbox".$task['id_task']."' class='id-checkbox'/></div>";
        $list .= "      <input type='hidden' value='".$task['id_users']."' id='hidden_value'>";
        $list .= "      <div class='div-description'><input type='button' value='Save text' class='btn-description' id='btn-description".$task['id_task']."' name='btn-description".$task['id_task']."' /></div>";
        $list .= "  </li>";
        $list .= "</form>";
    }

}

$list .= "</ul>";

echo $list;

?>
