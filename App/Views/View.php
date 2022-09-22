<?php

namespace App\Views;

abstract class View {
    public string $charset;
    public string $favicon;
    public string $title;

    public function __construct(string $charset = "", string $favicon = "", string $title = ""){
        $this->charset = $charset;
        $this->favicon = $favicon;
        $this->title = $title;
    }

    // Getters & Setters


    // Methods

    public function message() : string{
        return '<div class="message"></div>';
    }

    public function meta() : string{
        return '    <meta charset="'.$this->charset.'">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="'.$this->favicon.'">
        <title>'.$this->title.'</title>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/global.css?'.time().'">
        <link rel="stylesheet" href="css/style.css?'.time().'">
        <link rel="stylesheet" href="css/media.css?'.time().'">
        <link rel="icon" type="image/png" href="favicon.png">';
    }

    public function body():string {
        $dir = isset($_REQUEST['dir']) ? $_REQUEST['dir'] : 1;

        $body = "<!DOCTYPE html>
        <html lang='en'>
            <head>".self::meta()."</head>
            <body class='site'>
                ".self::message()."
                ".self::head()."
                ".self::nav()."
                <main class='main.";

                    /** CHANGEMENT DE PAGE **/
                    if($dir == '1'){
                        /** MODAL SI DATE LIMITE DEPASSEE **/
                        include 'includes/accueil.php';
                    }
                    if($dir == '2') include 'includes/createTask.php';
                    if($dir == '3') include 'includes/listTask.php';
                    if($dir == '4') include 'includes/historyTask.php';
                    if($dir == '5') include 'includes/connexion.php';

        $body .= "    </main>
        ".self::footer();

        var_dump($body);

        return $body;
    }

    public function filterPriority():string{
        $filterPriority = "<select id='sort-priority' name='sort-priority'>
        <option selected readonly>Tri par priorité</option>
        <option readonly></option>";

        for($i=1;$i<=5;$i++){
            $filterPriority .= "<option value='$i'>$i</option>";
        }

        $filterPriority .= "</select>";

        return $filterPriority;
    }
    public function head():string {
        return '<header class="header">
        <img src="img/logo.png" class="logo">
        <h1 class="site_title">'.mb_strtoupper($this->title).'</h1>
        </header>';
    }

    public function nav() : string{
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
    public function footer() : string{
        return '
        <footer class="footer">&copy; 2022 - Yann / Wildo</footer>
        <script src="js/functions.js"></script>
        <script src="js/script.js"></script>
        </body>
        </html>';
    }


    public function getHtml():string {
        return str_replace(array_map(fn($s)=>"{{".$s."}}", array_keys($this->getData())), array_values($this->getData()), $this->getContent());
    }

    public function display():void {
        echo $this->getHtml();
    }
}

?>