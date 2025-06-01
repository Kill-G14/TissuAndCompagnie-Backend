<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__ . '/../Src/db.php';
require __DIR__ . '/../vendor/autoload.php';

use App\Repositories\UserRepository;
use App\Services\UserService;

$request = json_decode(file_get_contents("php://input"));

if (!$request || !isset($request->action)) {
    echo json_encode(['success' => false, 'message' => 'Action non spécifiée.']);
    exit;
}

$repo = new UserRepository($pdo);
$service = new UserService($repo);

if ($request->action === 'updateUserInfos') {
    $response = $service->updateUserInfos($request);
    echo json_encode($response);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Action inconnue.']);
exit;
