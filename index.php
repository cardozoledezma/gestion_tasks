<?php
    /** INCLUSION DES VARIABLES GLOBALES **/
    include "globals.php";
    include "functions.php";
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

        ?>
    </main>
<?=footer()?>