<?php
require_once dirname($_SERVER['DOCUMENT_ROOT'])  . '/config/config_database.php';

class DataBase
{
    private static $connection = null;

    private function __construct() {}
    private function __clone() {}


    public static function connection()
    {
        if (self::$connection === null)
        {
            self::$connection = new \PDO("mysql:host=localhost;dbname=petprojects","root", "");
        }

        return self::$connection;
    }
}
