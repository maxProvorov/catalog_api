<?php

namespace App\Config;

use PDO;

class Database
{
    public static function getConnection(): PDO
    {
        $pdo = new PDO('sqlite:' . __DIR__ . '/../../database/database.sqlite');
        return $pdo;
    }
}