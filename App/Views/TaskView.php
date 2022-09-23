<?php

namespace App\Views;
use App\Models\Task;
use App\Models\Theme;

class TaskView extends View{
    public function __construct(){

        self::$filename = "App\Pages\index.html";
        static::$charset = "UTF-8";
        static::$favicon = "favicon.png";
        static::$title = "Gestion des tâches";

        self::setData([
            "meta" => self::meta(),
            "header" => self::head(),
            "navigation" => self::nav(),
            "message" => self::message(),
            "titlemain" => self::title(),
            "main" => self::main(),
            "footer" => self::footer(),
        ]);
        self::getContent();
        self::getHtml();
        self::display();
    }

    public function returnIdPage():int {
        return isset($_REQUEST['dir']) ? $_REQUEST['dir'] : 1;
    }

    public function message() : string{
        return '<div class="message"></div>';
    }

    public function title():string{
        $titles =["Liste des tâches en cours", "Créer une tâche", "Liste de toutes les tâches", "Historique des tâches"];
        return $titles[self::returnIdPage()-1];
    }

    public function meta():string {
        return '    <meta charset="'.static::$charset.'">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="'.static::$favicon.'">
        <title>'.static::$title.'</title>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/global.css?'.time().'">
        <link rel="stylesheet" href="css/style.css?'.time().'">
        <link rel="stylesheet" href="css/media.css?'.time().'">
        <link rel="icon" type="image/png" href="favicon.png">';
    }

    public function head():string {
        return '<header class="header">
        <img src="img/logo.png" class="logo">
        <h1 class="site_title">'.mb_strtoupper(static::$title).'</h1>
        </header>';
    }

    public function nav():string {
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

    public function main():string {
        $results = "";
        $tasks = new Task;

        if(self::returnIdPage() === 1) $results = $tasks->getSortTables();
        if(self::returnIdPage() === 3 || self::returnIdPage() == 4) $results = $tasks->getSortTables();

        $themes = new Theme;
        $listTH = array_map( fn($t) => ["id_task"=>$t['id_task'], "id_theme"=>$t['id_theme'], "theme_name"=>$t['theme_name']], $themes->getListThemes() );
        $themes = array_map(fn($t) => ["name"=>$t['theme_name']], $themes->getThemes());
        $nextID = null;

        $filterTheme = "<select id='sort-theme' name='sort-theme'>
        <option selected readonly>Tri par thème</option>
        <option readonly></option>";

        $filterPriority = "<select id='sort-priority' name='sort-priority'>
        <option selected readonly>Tri par priorité</option>
        <option readonly></option>";

        for($i=1;$i<=5;$i++){
            $filterPriority .= "<option value='$i'>$i</option>";
        }

        $filterPriority .= "</select>";

        foreach($themes as $index=>$theme){ $filterTheme .= "<option value='".($index+1)."'>".$theme['name']."</option>"; }

        $filterTheme .= "</select>";

        $list = "";
        $filters = (self::returnIdPage() == 1) ? "
            <div class='sort_list'>
                $filterPriority $filterTheme
            </div>
        <ul class='listTasks'>" : "";

        $list .= $filters;

        $j = 0;

        foreach($results as $task){

            $themeTask = [];

            if (!$task['done'] && $task['id_task'] != $nextID){

                $list .= "<form merthod='GET' action='update.php?id=".$task['id_task']."' id='formAccueil".$task['id_task']."' name='formAccueil".$task['id_task']."' class='formAccueil'>";
                $list .= $j == 0 ? "<li class='cellList refs'><div>Description</div><div>Priority</div><div>Date_reminder</div><div>Thème</div><div>ToDo</div><div>Save</div></li>" : "";
                $list .= "  <li class='cellList' style='background-color: ".$task['color'].";'>";
                $list .= "      <div class='description'><input type='text' value='".$task['description']."' id='id-description".$task['id_task']."' name='id-description".$task['id_task']."' ></div>";
                $list .= "      <div class='priority'>";
                $list .="           <span>Priorité</span><select id='select-priority' name='select-priority'>";

                for($i=1;$i<=5;$i++){
                    if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == $i) $list .= "              <option value='$i' selected>".$i."</option>";
                    else $list .= "              <option value='".$i."' ".($task['priority'] == $i ? "selected" : "").">".$i."</option>";
                }

                $list .= "          </select>";
                $list .= "      </div>";
                $list .= "      <div class='date'>".$task['date_reminder']."</div>";
                $list .= "      <div class='theme'>";

                $i = 1;

                foreach($listTH as $th){
                    $theme [] = "theme".$i;
                    if($th['id_task'] == $task['id_task']) $themeTask[] = "<label for='theme".$task['id_task']."'>".$th['theme_name']."</label><input type='checkbox' id='theme".$i."' name='theme".$i."' value='".$th['id_theme']."' checked><br>";
                    $i++;
                }

                $list .= implode(" ", $themeTask);
                $list .= "      </div>";
                $list .= "      <div class='div-checkbox'><span>Valider</span><input type='checkbox' value='".$task['id_task']."' id='id-checkbox".$task['id_task']."' name='id-checkbox".$task['id_task']."' class='id-checkbox' ".($task['done'] ? "checked" : "")."/></div>";
                $list .= "      <div class='div-description'><button class='btn-description' id='btn-description".$task['id_task']."' name='btn-description".$task['id_task']."'><i class='fa fa-floppy-o' aria-hidden='true'></i></button></div>";
                $list .= "  </li>";
                $list .= "</form>";
                $j++;
                $nextID = $task['id_task'];
            }
        }

        $list .= "</ul>";

        return  $list;
    }

    public function footer():string {
        return '
        <footer class="footer">&copy; 2022'.(date('Y') == "2022" ? "" : " - ".date('Y')).' - Yann / Wildo</footer>
        <script src="js/functions.js"></script>
        <script src="js/script.js"></script>
        </body>
        </html>';
    }

}

?>