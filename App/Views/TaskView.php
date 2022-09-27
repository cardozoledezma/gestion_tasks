<?php

namespace App\Views;
<<<<<<< HEAD

class TaskView extends View{
    public string $charset;
    public string $favicon;
    public string $title;

    
=======
use App\Models\Task;
use App\Models\Theme;

class TaskView extends View{
    public function __construct(){
        self::$filename = "App\Pages\index.html";
        static::$titles = [1=>"Accueil", 2=>"Créer une tâche", 3=>"Liste", 4=>"Historique", 5=>(isset($_SESSION['login']) ? "Déconnexion" : "Connexion")];
        static::$charset = "UTF-8";
        static::$favicon = "favicon.png";
        static::$title = "Gestion des tâches";

        self::setData([
            "meta"      => self::meta(),
            "header"    => self::head(),
            "navigation"=> self::nav(),
            "message"   => self::message(),
            "titlemain" => self::title(),
            "main"      => self::getpage(),
            "footer"    => self::footer(),
        ]);
        self::getContent();
        self::getHtml();
        self::display();
    }

    public function getPage():string {
        if(self::getIdPage() === 2)         return self::createTask();
        elseif(self::getIdPage() === 5 && !isset($_SESSION['login']))   return self::connection();
        elseif(self::getIdPage() === 5 && isset($_SESSION['login']))    return self::deconnection();
        elseif(self::getIdPage() <= 5)                                  return self::main();
    }
    public function getIdPage():int {
        return (isset($_REQUEST['dir']) && $_REQUEST['dir'] !== "" && $_REQUEST['dir'] <= sizeof(self::$titles) && $_REQUEST['dir'] > 0) ? $_REQUEST['dir'] : 1;
    }

    public function message() : string{
        return '<div class="message"></div>';
    }

    public function title():string{
        return self::$titles[self::getIdPage()];
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
        $html = '
        <nav class="navbar">
            <ul class="ul-navbar">
        ';

        foreach(self::$titles as $index=>$link){
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

        if(self::getIdPage() === 1) $results = $tasks->getSortTables();
        if(self::getIdPage() === 3) $results = $tasks->getAll();
        if(self::getIdPage() == 4)  $results = $tasks->getAllDone();

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
        $filters = self::getIdPage() == 1 ? "
            <div class='sort_list'>
                $filterPriority $filterTheme
            </div>
        <ul class='listTasks'>" : "";

        $list .= $filters;

        $j = 0;

        foreach($results as $task){

            $themeTask = [];

            if ($task['id_task'] != $nextID){

                $list .= "<form merthod='GET' action='update.php?id=".$task['id_task']."' id='formAccueil".$task['id_task']."' name='formAccueil".$task['id_task']."' class='formAccueil'>";

                $titleCells = isset($_SESSION['login']) && self::getIdPage() !== 1 ? "<div>ToDo</div>" : "";
                $titleCells .= self::getIdPage() !== 1 ? "<div>Save</div>" : "";

                $list .= $j == 0 ? "<li class='cellList refs'><div>Description</div><div>Priority</div><div>Date_reminder</div><div>Thème</div>$titleCells</li>" : "";
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
                    $disabled = isset($_SESSION['login']) ? "" : "disabled";
                    $disabled = self::getIdPage() == 1 ? "disabled" : $disabled;
                    if($th['id_task'] == $task['id_task']) $themeTask[] = "<label for='theme".$task['id_task']."'>".$th['theme_name']."</label><input type='checkbox' id='theme".$i."' name='theme".$i."' value='".$th['id_theme']."' checked $disabled><br>";
                    $i++;
                }

                $list .= implode(" ", $themeTask);
                $list .= "      </div>";

                if(self::getIdPage() !== 1){
                    $list .= "      <div class='div-checkbox'><span>Valider</span><input type='checkbox' value='".$task['id_task']."' id='id-checkbox".$task['id_task']."' name='id-checkbox".$task['id_task']."' class='id-checkbox' ".($task['done'] ? "checked" : "")."  $disabled/></div>";
                    if(isset($_SESSION['login']))$list .= "      <div class='div-description'><button class='btn-description' id='btn-description".$task['id_task']."' name='btn-description".$task['id_task']."'><i class='fa fa-floppy-o' aria-hidden='true'></i></button></div>";
                }

                $list .= "  </li>";
                $list .= "</form>";
                $j++;
                $nextID = $task['id_task'];
            }
        }

        $list .= "</ul>";

        return  $list;
    }

    public function createTask():string {

        if(isset($_SESSION['login'])){

            if(isset($_SERVER['HTTP_REFERER'])) $_SESSION['mytoken'] = md5(uniqid(mt_rand(), true));
            else{
                header('HTTP/1.0 404 Not Found');
                exit;
            }

            $themes = new Theme;
            $themes = array_map(fn($t) => ["name"=>$t['theme_name']], $themes->getThemes());

            $create = '
            <div class="divFormCreate">
                <form method="post" action="./includes/insert.php" name="form-create-task" id="form-create-task" class="formCreate" enctype="multipart/form-data">
                    <label for="nameTask" id="labelTask">Nom de la tâche</label>
                    <input type="text" id="nameTask" name="nameTask" placeholder="Entrer nom de la tâche">
                    <label for="selectTheme" id="labelTheme">Thème de la tâche
                        <div class="infosSelectMultiple"><i class="fa fa-question-circle" id="iQuestion"aria-hidden="true"></i>
                            <p>En mode mobile, on doit cliquer à droite du texte pour faire une sélection multiple, pour déselectionner utiliser la même méthode
                            </p>
                        </div>
                    </label>
                    <select id="selectTheme" name="selectTheme" class="select-theme" multiple>
                        <option readonly disabled>Thème de la tâche</option>
                        <option readonly disabled></option>';

                            foreach($themes as $index=>$theme){
                                $create .= '<option value="'.$index.'">'.$theme['name'].'</option>';
                            }

                    $create .= '
                    </select>
                    <label for="selectPriority" id="labelPriority">Priorité de la tâche</label>
                    <select id="selectPriority" name="selectPriority" class="select-priority">
                        <option readonly disabled>Priorité de la tâche</option>
                        <option readonly disabled></option>';

                            for($i=1;$i<=5;$i++){
                                $create .= "<option value='$i'>$i</option>";
                            }

                    $create .= '
                    </select>
                    <label for="selectColor" id="labelColor">Choix de la couleur de la tâche</label>
                    <input type="color" id="choiceColor" name="choiceColor" class="choice-color" value="">
                    <input type="hidden" id="selectColor" name="selectColor">
                    <label for="inputDate" id="labelDate">Choix de la date de rappel</label>
                    <input type="date" id="inputDate" name="inputDate">
                    <input type="hidden" id="token" name="token" value="'.$_SESSION['mytoken'].'">
                    <input type="submit" value="Enregistrer la tâche" id="createSubmit" '.($_SERVER['HTTP_REFERER'] === null ? "disabled" : "").'>
                </form>
            </div>';

            return $create;
        }
        else{
            $create = '<p>Vous devez vous connecter pour pouvoir ajouter une tâche...</p>';
            
            return $create;
        }
    }

    public function connection():string {
        return "
        <div class='pageConnexion'>
            <form method='post' action='./includes/connexion.php' id='formConnexion' name='formConnexion' enctype='multipart/form-data'>
                <input type='text' id='logUser' name='logUser' placeholder='Pseudo'>
                <input type='password' id='passUser' name='passUser' placeholder='Mot de passe'>
                <input type='button' value='Inscription' id='btnInscription' name='btnInscription'>
                <input type='submit' value='Se connecter' id='btnConnexion' name='btnConnexion'>
            </form>
        </div>
        ";
    }
    public function deconnection():string {
        return "
        <div class='pageConnexion'>
            <form method='POST' action='./includes/deconnexion.php' id='formDeconnexion' name='formDeconnexion'>
                <input type='submit' value='Se déconnecter' id='btnDeconnexion' name='btnDeconnexion'>
            </form>
        </div>
        ";
    }

    public function footer():string {
        return '
        <footer class="footer">&copy; 2022'.(date('Y') == "2022" ? "" : " - ".date('Y')).' - Yann / Wildo</footer>
        <script src="js/functions.js"></script>
        <script src="js/script.js"></script>
        </body>
        </html>';
    }
>>>>>>> 6c3bb4b8d99da435572cc979e91136fec9eff0c3

}

?>