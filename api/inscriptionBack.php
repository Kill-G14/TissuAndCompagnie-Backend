<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

require __DIR__.'/../Src/db.php';
require __DIR__.'/../vendor/autoload.php';

use App\Services\UserService;
use App\Repositories\UserRepository;


$request = json_decode(file_get_contents('php://input'));

if ($request === null) {
    echo json_encode(['success' => false, 'message' => 'Aucune donnée reçue ou format invalide']);
    exit;
}


$repo = new UserRepository($pdo);
$service = new UserService($repo);

switch ($request->action) {
    case 'registerNewUser':
        $response = $service->registerUser($request);
        echo json_encode($response);
        break;

    case 'connect':
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Action non reconnue !']);
        break;
}
