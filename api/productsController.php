<?php
// header(header: 'Content-Type: application/json');
header(header: "Access-Control-Allow-Origin: *");
header(header: "Access-Control-Allow-Methods: GET, POST, OPTIONS");
header(header: "Access-Control-Allow-Headers: Content-Type");

require __DIR__.'/../Src/db.php';
require __DIR__.'/../vendor/autoload.php';
use App\Services\ProductsService;
use App\Repositories\ProductsRepository;


$request = json_decode(file_get_contents("php://input"));
$repo = new ProductsRepository($pdo);
$service = new ProductsService($repo);

if (!isset($request->action)) {
    $data = [
        'status' => 'error',
        'message' => 'Action obligatoire'
    ];
    echo json_encode($data);
    exit;
}
switch ($request->action) {
    case 'getProducts':
        $type = $request->type;
        $page = $request->page;
        $perPage = $request->perPage;
        $products = $service->getPaginatedProducts($type, $page, $perPage);
        $data = [
            'status' => 'success',
            'data' => $products
        ];
        break;
    default:
        $data = [
            'status' => 'error',
            'message' => 'Cette action est inconnue : '.$request->action
        ];
        break;
}

echo json_encode($data);

