<?php

namespace App\Services;

use PDO;

class DBConnexion
{

    private PDO $pdo;
    public function __construct()
    {
        $host = "localhost"; 
        $user = "root"; 
        $pass = ""; 
        $db = "tissuetcompagnie";
        $connexionString = "mysql:host=$host;dbname=$db;charset=utf8mb4;port=3306";

        $this->pdo = new PDO($connexionString, $user, $pass);
    }

    public function getDB(): PDO
    {
        return $this->pdo;
    }
}