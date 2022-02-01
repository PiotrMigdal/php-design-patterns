<?php

// Singleton is a fancy method for global variable like $db
// It is good for db connections because it makes that you have only one instance of a class

class Database {
    public static $instance;

    public static function geInstance()
    {
        if(!isset(Database::$instance)){
            Database::$instance = new Database();
        }

        return Database::$instance;
    }

}

$db = Database::geInstance();
$db2 = Database::geInstance();

var_dump($db);
var_dump($db2);// Return the same instance

