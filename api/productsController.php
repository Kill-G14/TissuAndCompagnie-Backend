<?php
header(header: "Access-Control-Allow-Origin: *");
header(header: "Access-Control-Allow-Methods: GET, POST, OPTIONS");
header(header: "Access-Control-Allow-Headers: Content-Type");

require '../Src/Repositories/ProductsRepository.php';
require '../Src/Services/productService.php';
require '../Src/db.php';

// Configuration DB
$pdo = new PDO("mysql:host=localhost;dbname=tissuetcompagnie;charset=utf8", "root", "");

// Récupération paramètres GET
$type = $_GET['type'] ?? 'button';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$perPage = 28;

// Appel des services
$repo = new ProductsRepository($pdo);
$service = new ProductsService($repo);
$data = $service->getPaginatedProducts($type, $page, $perPage);

// Réponse JSON
header('Content-Type: application/json');
echo json_encode($data);
