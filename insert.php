<?php

    spl_autoload_register();

    use App\Models\Task;

    header("Content-Type: application/json charset=UTF-8");
    echo Task::insertTask();
   

?>