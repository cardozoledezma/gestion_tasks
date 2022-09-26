<?php

namespace App\Controllers;
use App\Models\Product;
use App\Models\Task;

class TaskController{

    public function index(){
        $tasks = new Task;
        $tasks->getAll();
    }

    public function create(){

    }

    public function show(){

    }

    public function store(){

    }
}


?>