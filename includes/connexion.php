<?php


require_once "../App/Models/Model.php";
require_once "../App/Models/Task.php";

use App\Models\Task as TaskModel;

session_start();

$tasks = new TaskModel;

if($_SERVER['HTTP_REFERER']) $results = $tasks->createConnection();

if($results) $_SESSION['login'] =  $results;

header("Refresh:2; url=".$_SERVER['HTTP_REFERER']);

?>