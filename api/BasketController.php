<?php
header('Content-Type: application/json');


require_once __DIR__ . '/../vendor/autoload.php';

// Models
// repositories 
use App\Repositories\BasketRepository;
// Validator
// services
use App\Services\DBConnexion;


$DBConnexion = new DBConnexion();
$pdo = $DBConnexion->getDB();

// Models
// repositories 
$basketRepository = new BasketRepository($pdo);
// Validator
// services


$request = json_decode(file_get_contents('php://input'));
$productId = intval($request->productId ?? 0);
$quantity = intval($request->quantity ?? 1);


echo json_encode(['status' => 'success']);
