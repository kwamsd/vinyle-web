<?php

namespace Src\Utils;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database
{
    private static $instance = null;

    private static function loadConfig(): array
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        return [
            'host'     => $_ENV['DB_HOST'] ?? '127.0.0.1',
            'dbname'   => $_ENV['DB_NAME'] ?? '',
            'username' => $_ENV['DB_USER'] ?? '',
            'password' => $_ENV['DB_PASS'] ?? '',
        ];
    }

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $cfg = self::loadConfig();

            try {
                $dsn = sprintf(
                    'mysql:host=%s;dbname=%s;charset=utf8',
                    $cfg['host'],
                    $cfg['dbname']
                );
                self::$instance = new PDO(
                    $dsn,
                    $cfg['username'],
                    $cfg['password']
                );
                self::$instance->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}