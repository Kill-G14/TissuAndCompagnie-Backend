<?php 

$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$db = ""; // nom de la base de données

try { 
    $connectionString = "mysql:host=$host;dbname=$db;charset=utf8";
    $pdo = new PDO($connectionString, $user, $pass);
}   
    catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
}