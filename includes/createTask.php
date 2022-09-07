<?php

include "globals.php";

$SQL = "SELECT * FROM theme;";
$requete = $dbCo->prepare($SQL);
$requete->execute();


?>

<form method="get" action="index.php?page=6" name="form-create-task" id="form-create-task" class="formCreate">
    <input type="text" id="nameTask" name="nameTask" placeholder="Entrer nom de la tâche">
        <select id="selectTheme" name="selectTheme" class="select-theme">
            <option selected readonly>Thème de la tâche</optiopn>
            <option readonly></optiopn>
            <?php

                foreach($result = $requete->fetchAll() as $res){
                    echo '<option value="'.$res['theme_name'].'">'.$res['theme_name'].'</option>';
                }

            ?>
        </select>
    <input type="submit" value="Enregristrer la tâche">
</form>
