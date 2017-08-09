<?php

class Db
{

    private static $dbConnection;

    public static function getConnection()
    {
        if (self::$dbConnection) return self::$dbConnection;

        $paramsPath = ROOT . '/config/db_params.php';

        $params = include($paramsPath);


        $dsn = "mysql:host=" . $params['host'] . ";dbname=" . $params['dbname'];

        $db = new PDO($dsn, $params['user'], $params['password']);

        self::$dbConnection = $db;

        return self::$dbConnection;
    }


}