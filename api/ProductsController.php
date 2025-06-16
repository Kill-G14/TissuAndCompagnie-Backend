<?php
// header(header: 'Content-Type: application/json');
header(header: "Access-Control-Allow-Origin: *");
header(header: "Access-Control-Allow-Methods: GET, POST, OPTIONS");
header(header: "Access-Control-Allow-Headers: Content-Type");

require __DIR__.'/../vendor/autoload.php';

// Models
// repositories 
use App\Repositories\ProductsRepository;
// Validator
// services
use App\Services\ProductsService;
use App\Services\DBConnexion;


$DBConnexion = new DBConnexion();
$pdo = $DBConnexion->getDB();



// Models
// repositories 
$userRepository = new ProductsRepository($pdo);
// Validator
// services
$productsService = new ProductsService($productsRepository);

$request = json_decode(file_get_contents("php://input"));


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

