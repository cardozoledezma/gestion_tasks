<?php

$nextID = null;
$themeTask = [];
$color_use = 0;
$j = 0;

/** VARIABLES **/
$date = date("Y-m-d");
/*** DEFINE PAGE ***/
$dir = isset($_REQUEST['dir']) ? $_REQUEST['dir'] : 1;

$colors = [ "f7d9d9", "dad9f7", "e0f7d9", "e6f2b6", "f49f9f", "f7ba74", "9ef5db", "a4b7d7" ];

$filterPriority = "<select id='sort-priority' name='sort-priority'>
    <option selected readonly>Tri par priorité</option>
    <option readonly></option>";

    for($i=1;$i<=5;$i++){
        $filterPriority .= "<option value='$i'>$i</option>";
    }

$filterPriority .= "</select>";

?>