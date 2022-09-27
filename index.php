<?php
<<<<<<< HEAD
    spl_autoload_register();
    /** INCLUSION DES VARIABLES GLOBALES **/
    require_once "_config.php";
    // require_once "functions.php";

    use App\Models\Task;
    use App\Models\Theme;
    use App\Views\View;
    use App\Views\TaskView;

    $view = new TaskView("UTF-8", "favicon.png", "Gestion des tâches");
    $view->body();

// "UTF-8", "favicon.png", "Gestion des tâches"
?>


=======

session_start();

spl_autoload_register();

use App\Models\Task;
use App\Models\Theme;
use App\Views\TaskView;
use App\Views\View;

new TaskView;

?>
>>>>>>> 6c3bb4b8d99da435572cc979e91136fec9eff0c3
