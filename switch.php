<?php

$p = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 1;

switch($p){
    case 1: include "includes/accueil.php";break;
    case 2: include "includes/createTask.php";break;
    case 3: include "includes/listTask.php";break;
    case 4: include "includes/historyTask.php";break;
    case 5: include "includes/contact.php";break;
    case 6: include "includes/bddCreate.php";break;

    default: include "includes/accueil.php";break;
}

?>