<?php

declare(strict_types=1);

namespace App;

use PDO;

class DB
{
    private PDO $pdo;
    private static ?PDO $dbConnection = null;

    public function __construct(array $config)
    {
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $db_host = $config['host'];
        $db_name = $config['database'];
        $db_pass = $config['pass'];
        $db_user = $config['user'];
        $db_port = $config['port'];
        try {
            $this->pdo = new PDO(
                'mysql:host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['database'],
                $config['user'],
                $config['pass'],
                $config['options'] ?? $defaultOptions
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }

    public static function getConnection(): PDO
    {
        if (self::$dbConnection === null) {
            self::$dbConnection = new PDO(
                'mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_DATABASE'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS'],
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );
        }

        return self::$dbConnection;
    }
}
