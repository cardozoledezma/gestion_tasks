<?php

include "globals.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png">
    <title>Gestion Tasks</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/style.css?<?=time()?>">
</head>
<body class="site">
    <header class="header">
        <img src="img/logo.png" class="logo">
        <h1 class="site_title">GESTION DES TÂCHES</h1>
    </header>
    <nav class="navbar">
        <ul class="ul-navbar">
            <li  class="li-navbar"><a class="lnk-navbar" href="index.php?page=1">Accueil</a></li>
            <li  class="li-navbar"><a class="lnk-navbar" href="index.php?page=2">Créer une tâche</a></li>
            <li  class="li-navbar"><a class="lnk-navbar" href="index.php?page=3">Liste des tâches</a></li>
            <li  class="li-navbar"><a class="lnk-navbar" href="index.php?page=4">Historique</a></li>
            <li  class="li-navbar"><a class="lnk-navbar" href="index.php?page=5">Contact</a></li>
        </ul>
        <button id="mobile-button" class="nav-burger"><i id="mobile-icon" class="fa fa-bars" aria-hidden="true"></i></button>
    </nav>
    <main class="main">
        <?php  include "switch.php"; ?>
    </main>
<?=$footer?>