<?php

namespace App\Models;

use App\Controllers\TaskController;
use PDO;
use FFI\Exception;

abstract class Model{
    protected static ?PDO $connection = null;
    protected static $dbOptions = [ PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC ];

    public function __construct(){
        if(self::$connection instanceof PDO) return;
        try {
            self::$connection = new PDO( 'mysql:host=localhost;dbname=list_task_test;charset=utf8', 'xloadx', 'r86bs9kp', self::$dbOptions);
        }
        catch (Exception $e) {
            die("Unable to connect to the database.".$e->getMessage());
        }
    }

    public function getSql():string {
        return $this->sql;
    }
    public function setSql(string $sql):void {
        $this->$sql = $sql;
    }
}

?>