<?php
header(header: "Access-Control-Allow-Origin: *");
header(header: "Access-Control-Allow-Methods: GET, POST, OPTIONS");
header(header: "Access-Control-Allow-Headers: Content-Type");

require '../Src/Repositories/ProductsRepository.php';
require '../Src/Services/productService.php';
require '../Src/db.php';

$pdo = new PDO("mysql:host=localhost;dbname=tissuetcompagnie;charset=utf8", "root", "");

$type = $_GET['type'] ?? 'button';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$perPage = 28;

$repo = new ProductsRepository($pdo);
$service = new ProductsService($repo);
$data = $service->getPaginatedProducts($type, $page, $perPage);

header('Content-Type: application/json');
echo json_encode($data);
