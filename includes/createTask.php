<div class="title">Liste des tâches en cours</div>
<div class="divFormCreate">
    <form method="get" action="index.php?page=6" name="form-create-task" id="form-create-task" class="formCreate">
        <label for="nameTask" id="labelTask">Nom de la tâche</label>
        <input type="text" id="nameTask" name="nameTask" placeholder="Entrer nom de la tâche">
        <label for="selectTheme" id="labelTheme">Thème de la tâche</label>
        <select id="selectTheme" name="selectTheme" class="select-theme">
            <option selected readonly>Thème de la tâche</option>
            <option readonly></option>
            <?php

                foreach($themes as $theme){
                    echo '<option value="'.$theme['name'].'">'.$theme['name'].'</option>';
                }

            ?>
        </select>
        <label for="selectPriority" id="labelPriority">Priorité de la tâche</label>
        <select id="selectPriority" name="selectPriority" class="select-priority">
            <option selected readonly>Priorité de la tâche</option>
            <option readonly></option>
            <?php

                for($i=1;$i<=5;$i++){
                    echo "<option value='$i'>$i</option>";
                }

            ?>
        </select>
        <label for="selectColor" id="labelColor">Choix de la couleur de la tâche</label>
        <select id="selectColor" name="selectColor" class="select-color">
            <option selected readonly>Choix de la couleur</option>
            <option readonly></option>
            <?php

                for($i=1;$i<=8;$i++){
                    echo "<option value='$i'>$i</option>";
                }

            ?>
        </select>
        <input type="submit" value="Enregistrer la tâche" id="createSubmit">
    </form>
</div>
