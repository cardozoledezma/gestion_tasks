<?php

$date = date("Y-m-d");
$dir = isset($_REQUEST['dir']) ? $_REQUEST['dir'] : 1;

try {
    $dbOptions = [ PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC ];
    $dbCo = new PDO( 'mysql:host=localhost;dbname=list_task;charset=utf8', 'xloadx', 'r86bs9kp', $dbOptions);
}
catch (Exception $e) {
    die("Unable to connect to the database.".$e->getMessage());
}

/************** REQUETE ACCUEIL ************/
$SQL = "SELECT * FROM task";
$SQL .= (isset($_REQUEST['sort'])) ? " ORDER BY priority" : "";

$requete = $dbCo->prepare($SQL);
$requete->execute();
/************** DONNEES DE LA BASE *********/
$tasks = array_map(fn($t) => ["id_task"=>$t['id_task'], "description"=>$t['description'], "color"=>$t['color'], "priority"=>$t['priority'], "date_reminder"=>$t['date_reminder'], "done"=>$t['done'], "id_users"=>$t['id_users']], $requete->fetchAll());


$footer = '
    <footer class="footer">&copy; 2022 - Yann / Wildo</footer>
    <script src="js/script.js"></script>
</body>
</html>';

$color = [ "f7d9d9", "dad9f7", "e0f7d9", "f7f7d9", "f7e9d9", "eed9f7", "f7d9f6", "d9f7f7" ];

$sortPriority = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : '';

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

?>