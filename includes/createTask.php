<?php

namespace App\Models;

use App\Models\Task;

if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != null){

?>
<div class="title">Liste des tâches en cours</div>
<div class="divFormCreate">
    <form method="POST" action="index.php?page=6" name="form-create-task" id="form-create-task" class="formCreate">
        <label for="nameTask" id="labelTask">Nom de la tâche</label>
        <input type="text" id="nameTask" name="nameTask" placeholder="Entrer nom de la tâche">
        <label for="selectTheme" id="labelTheme">Thème de la tâche
            <div class="infosSelectMultiple"><i class="fa fa-question-circle" id="iQuestion"aria-hidden="true"></i>
                <p>En mode mobile, on doit cliquer à droite du texte pour faire une sélection multiple, pour déselectionner utiliser la même méthode
                </p>
            </div>
        </label>
        <select id="selectTheme" name="selectTheme" class="select-theme" multiple>
            <option readonly disabled>Thème de la tâche</option>
            <option readonly disabled></option>
            <?php

                $listTH = array_map( fn($t) => ["id_task"=>$t['id_task'], "id_theme"=>$t['id_theme'], "theme_name"=>$t['theme_name']], $themes->getListThemes() );
                $themes = array_map(fn($t) => ["name"=>$t['theme_name']], $themes->getThemes());

                foreach($themes as $index=>$theme){
                    echo '<option value="'.($index+1).'">'.$theme['name'].'</option>';
                }

            ?>
        </select>
        <label for="selectPriority" id="labelPriority">Priorité de la tâche</label>
        <select id="selectPriority" name="selectPriority" class="select-priority">
            <option readonly disabled>Priorité de la tâche</option>
            <option readonly disabled></option>
            <?php

                for($i=1;$i<=5;$i++){
                    echo "<option value='$i'>$i</option>";
                }

            ?>
        </select>
        <label for="selectColor" id="labelColor">Choix de la couleur de la tâche</label>
        <input type="color" id="choiceColor" name="choiceColor" class="choice-color" value="">
        <input type="hidden" id="selectColor" name="selectColor">
        <label for="inputDate" id="labelDate">Choix de la date de rappel</label>
        <input type="date" id="inputDate" name="inputDate">
        <input type="submit" value="Enregistrer la tâche" id="createSubmit">

</div>
    </form>
</div>

<?php

}
else echo "<span class='infoReferer'>Ceci est un duplicata du formulaire en cours...</span>";

?>
