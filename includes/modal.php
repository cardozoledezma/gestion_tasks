<?php

$sql = "SELECT * FROM task WHERE date_reminder <= '$date' AND done <> false";
$req_modal = $dbCo->prepare($sql);
$req_modal->execute();

$recall = array_map( fn($t) => ["id_task"=>$t['id_task'], "description"=>$t['description'], "priority"=>$t['priority'], "date_reminder"=>$t['date_reminder'] ], $req_modal->fetchAll());
var_dump($recall);

$modal = "
<div class='close_modal' id='close_modal'>X</div>
    <div class='modal_task'>";

        foreach($recall as $rec){
            $modal .= "
            <div class='modal_task_detail'>
                <span>Nom de la tâche :</span>".$rec['id_task']."<span></span>
                <span>Description :</span>".$rec['description']."<span></span>
                <span>Priorité :</span>".$rec['priority']."<span></span>
                <span>Date de rappel :</span><span>".$rec['date_reminder']."</span>
            </div>";
        }

$modal .= "
    </div>
</div>";

echo $modal;

?>