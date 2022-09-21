<?php

namespace App\Models;
use PDO;
use FFI\Exception;

abstract class Model{
    protected PDO $connection;

    public function __construct(){
        try {
            $dbOptions = [ PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC ];
            $this->connection = new PDO( 'mysql:host=localhost;dbname=list_task_test;charset=utf8', 'xloadx', 'r86bs9kp', $dbOptions);
        }
        catch (Exception $e) {
            die("Unable to connect to the database.".$e->getMessage());
        }
    }
}

?>