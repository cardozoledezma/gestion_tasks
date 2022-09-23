<?php
    spl_autoload_register();
    /** INCLUSION DES VARIABLES GLOBALES **/
    require_once "_config.php";
    require_once "functions.php";

    use App\Models\Task;
    use App\Models\Theme;
    use App\Views\TaskView;
    use App\Views\View;

    new TaskView;

?>