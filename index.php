<?php

session_start();

spl_autoload_register();

use App\Models\Task;
use App\Models\Theme;
use App\Views\TaskView;
use App\Views\View;

new TaskView;

?>