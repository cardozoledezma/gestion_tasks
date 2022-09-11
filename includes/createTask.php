
<form method="get" action="index.php?page=6" name="form-create-task" id="form-create-task" class="formCreate">
    <input type="text" id="nameTask" name="nameTask" placeholder="Entrer nom de la tâche">
        <select id="selectTheme" name="selectTheme" class="select-theme">
            <option selected readonly>Thème de la tâche</optiopn>
            <option readonly></optiopn>
            <?php

                foreach($themes as $theme){
                    echo '<option value="'.$theme['name'].'">'.$theme['name'].'</option>';
                }

            ?>
        </select>
    <input type="submit" value="Enregristrer la tâche">
</form>
