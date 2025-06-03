<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__ . '/../Src/db.php';
require __DIR__ . '/../vendor/autoload.php';
// Models
// repositories 
use App\Repositories\UserRepository;
// Validator
use App\Services\EmailValidatorService;
// services
use App\Services\UserService;


// Models
// repositories 
$userRepository = new UserRepository($pdo);
// Validator
$emailValidator = new EmailValidatorService();
// services
$userService = new UserService($userRepository , $emailValidator);

$request = json_decode(file_get_contents("php://input"));

if (!$request || !isset($request->action)) {
    echo json_encode(['success' => false, 'message' => 'Action non spécifiée.']);
    exit;
}

if ($request->action === 'updateUserInfos') {
    $response = $userService->updateUserInfos($request);
    echo json_encode($response);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Action inconnue.']);
exit;
