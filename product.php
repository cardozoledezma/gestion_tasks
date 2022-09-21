<?php
spl_autoload_register();

use App\Controllers\ProductController;

$controller = new ProductController;

if(isset($_GET['action']) && $GET['action'] === 'create'){ $controller->create();exit; }

$controller->index();

?>