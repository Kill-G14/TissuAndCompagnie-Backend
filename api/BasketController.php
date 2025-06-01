<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../Src/db.php';
require_once __DIR__ . '/../vendor/autoload.php';
use App\Repositories\BasketRepository;

$repo = new BasketRepository($pdo);


if (!isset($_SESSION['userId'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Utilisateur non connecté']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$userId = $_SESSION['userId'];
$productId = intval($data['productId']);
$quantity = intval($data['quantity'] ?? 1);


echo json_encode(['status' => 'success']);
