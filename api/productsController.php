<?php
header(header: "Access-Control-Allow-Origin: *");
header(header: "Access-Control-Allow-Methods: GET, POST, OPTIONS");
header(header: "Access-Control-Allow-Headers: Content-Type");

require '../Src/Repositories/ProductsRepository.php';
require '../Src/Services/productService.php';
require '../Src/db.php';


$type = $_POST['type'] ?? 'button';
$page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
$perPage = 28;

$request = json_decode(json: file_get_contents(filename: 'php://input'));
$request->action;

$repo = new ProductsRepository($pdo);
$service = new ProductsService($repo);
$data = $service->getPaginatedProducts($type, $page, $perPage);

header('Content-Type: application/json');
echo json_encode($data);

