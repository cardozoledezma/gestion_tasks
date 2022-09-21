<?php
    spl_autoload_register();
    /** INCLUSION DES VARIABLES GLOBALES **/
    require_once "_config.php";
    require_once "functions.php";

    use App\Models\Task;
    use App\Models\Theme;

    $page = new Page("UTF-8", "favicon.png", "Gestion des tâches");

    $tasks = new Task;
    $themes = new Theme;

    /*** REQUEST ONGOING TASKS ***/
    $results = $tasks->getAll();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?=$page->meta()?>
    </head>
    <body class="site">
        <?=$page->message()?>
        <?=$page->head()?>
        <?=$page->nav()?>
        <main class="main">
            <?php

            /** CHANGEMENT DE PAGE **/
            if($dir == "1"){
                /** MODAL SI DATE LIMITE DEPASSEE **/
                include "includes/accueil.php";
                // include "includes/modal.php";
            }
            if($dir == "2") include "includes/createTask.php";
            if($dir == "3") include "includes/listTask.php";
            if($dir == "4") include "includes/historyTask.php";
            if($dir == "5") include "includes/connexion.php";

        ?>
    </main>
<?=$page->footer()?>