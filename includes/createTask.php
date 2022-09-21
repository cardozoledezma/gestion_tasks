<?php

$themes = array_map(fn($t) => ["name"=>$t['theme_name']], $themes->getThemes());

?>
<div class="title">Liste des tâches en cours</div>
<div class="divFormCreate">
    <form method="get" action="index.php?page=6" name="form-create-task" id="form-create-task" class="formCreate">
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

                foreach($themes as $index=>$theme){
                    echo '<option value="'.$index.'">'.$theme['name'].'</option>';
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
        <select id="selectColor" name="selectColor" class="select-color">
            <option readonly disabled>Choix de la couleur</option>
            <option readonly disabled></option>
            <?php

                for($i=1;$i<=8;$i++){
                    echo "<option value='$i'>$i</option>";
                }

            ?>
        </select>
        <label for="inputDate" id="labelDate">Choix de la date de rappel</label>
        <input type="date" id="inputDate" name="inputDate">
        <input type="submit" value="Enregistrer la tâche" id="createSubmit">
    </form>
</div>
