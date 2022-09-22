<?php

namespace App\Controllers;
use App\Pages\Page;
use App\Models\Task;
use App\Models\Theme;
use DateTime;

class TaskController{

    public function index(array $list){

        session_start();

        $_SESSION['token'] = md5(uniqid(mt_rand(), true));

        $page = new Page("UTF-8", "favicon.png", "Gestion des tâches");
        $tasks = new Task;
        $themes = new Theme;

        /*** REQUEST ONGOING TASKS ***/
        $results = $tasks->getAll();
    }

    public function create(){

    }

    public function show(){

    }

    public function store(){

    }
}


?>