<?php

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

require __DIR__ . '/../Src/db.php';
require __DIR__ . '/../vendor/autoload.php';

// Models
// repositories 
use App\Repositories\UserRepository;
use App\Repositories\SessionRepository;
// Validator
// services
use App\Services\UserService;
use App\Services\EmailValidatorService;
use App\Services\SessionService;

// Models
// repositories 
$userRepository = new UserRepository($pdo);
$sessionRepository = new SessionRepository($pdo);
// Validator
$emailValidator = new EmailValidatorService();
// services
$userService = new UserService($userRepository, $emailValidator);
$sessionService = new SessionService($userRepository, $sessionRepository);

$request = json_decode(file_get_contents("php://input"));

switch ($request->action) {
    case 'connect':
        $email = $request->email ?? null;
        $password = $request->password ?? null;
        $result = $sessionService->loginUser($email, $password);
        $response = ['success' => true, 'message' => 'Connection réussie', 'token' => $result]; 
        break;

    default:
        $response =['success' => false, 'message' => 'Action non reconnue !'];
        break;
}

echo json_encode($response);

