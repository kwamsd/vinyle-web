<?php

namespace Src\Utils;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;

    private static $dbConfig = [
        'host' => '127.0.0.1',
        'dbname' => 'vinyle_catalogue',
        'username' => 'root',
        'password' => 'koukou20', 
    ];

    public static function getConnection()
    {
        if (self::$instance === null) {
            try {
                $dsn = 'mysql:host=' . self::$dbConfig['host'] . ';dbname=' . self::$dbConfig['dbname'] . ';charset=utf8';
                self::$instance = new PDO($dsn, self::$dbConfig['username'], self::$dbConfig['password']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
