<?php
    /** INCLUSION DES VARIABLES GLOBALES **/
    require_once "globals.php";
    require_once "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?=meta()?>
    </head>
    <body class="site">
        <?=head()?>
        <?=nav()?>
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
<?=footer()?>