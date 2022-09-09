<?php

function meta() : string{
    return '    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png">
    <title>Gestion Tasks</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/style.css?'.time().'">';
}

function head() : string{
    return '<header class="header">
    <img src="img/logo.png" class="logo">
    <h1 class="site_title">GESTION DES TÂCHES</h1>
    </header>';
}
function nav() : string{
    $menu = [1=>"Accueil", 2=>"Créer une tâche", 3=>"Liste des tâches", 4=>"Historique", 5=>"Connexion" ];

    $html = '
    <nav class="navbar">
        <ul class="ul-navbar">
    ';

    foreach($menu as $index=>$link){
        $html .= '      <li  class="li-navbar"><a class="lnk-navbar" href="index.php?page=1&dir='.$index.'">'.$link.'</a></li>';
    }

    $html .= '  </ul>
        <button id="mobile-button" class="nav-burger"><i id="mobile-icon" class="fa fa-bars" aria-hidden="true"></i></button>
    </nav>';

    return $html;
}
function footer() : string{
    return '
    <footer class="footer">&copy; 2022 - Yann / Wildo</footer>
    <script src="js/script.js"></script>
    </body>
    </html>';
}

?>