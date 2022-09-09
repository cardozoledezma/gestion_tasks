<?php

function meta() : string{
    $html = '    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png">
    <title>Gestion Tasks</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/style.css?'.time().'">';
    return $html;
}

function head() : string{
    $html =  '<header class="header">
    <img src="img/logo.png" class="logo">
    <h1 class="site_title">GESTION DES TÂCHES</h1>
    </header>';
    return $html;
}
function nav() : string{
    $html = '    <nav class="navbar">
    <ul class="ul-navbar">
        <li  class="li-navbar"><a class="lnk-navbar" href="index.php?page=1&dir=1">Accueil</a></li>
        <li  class="li-navbar"><a class="lnk-navbar" href="index.php?page=1&dir=2">Créer une tâche</a></li>
        <li  class="li-navbar"><a class="lnk-navbar" href="index.php?page=1&dir=3">Liste des tâches</a></li>
        <li  class="li-navbar"><a class="lnk-navbar" href="index.php?page=1&dir=4">Historique</a></li>
    </ul>
    <button id="mobile-button" class="nav-burger"><i id="mobile-icon" class="fa fa-bars" aria-hidden="true"></i></button>
    </nav>';
    return $html;
}
function footer() : string{
    $html = '
    <footer class="footer">&copy; 2022 - Yann / Wildo</footer>
    <script src="js/script.js"></script>
    </body>
    </html>';
    return $html;
}

?>