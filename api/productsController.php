<?php
// header(header: 'Content-Type: application/json');
header(header: "Access-Control-Allow-Origin: *");
header(header: "Access-Control-Allow-Methods: GET, POST, OPTIONS");
header(header: "Access-Control-Allow-Headers: Content-Type");

require __DIR__.'/../vendor/autoload.php';
use App\Repositories\ProductsRepository;
use App\Services\ProductsService;

$repo = new ProductsRepository($pdo);
$service = new ProductsService($repo);

// $request = json_decode(json: file_get_contents(filename: 'php://input'));
$request = json_decode("{ \"action\": \"getProducts\", \"type\": \"cloth\", \"page\": 1, \"perPage\": 2}");
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

