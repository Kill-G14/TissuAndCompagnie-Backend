<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__ . '/../vendor/autoload.php';

// Models
// repositories 
use App\Repositories\UserRepository;
use App\Repositories\SessionRepository;
// Validator
// services
use App\Services\UserService;
use App\Services\EmailValidator;
use App\Services\SessionService;
use App\Services\DBConnexion;


$DBConnexion = new DBConnexion();
$pdo = $DBConnexion->getDB();


// Models
// repositories 
$userRepository = new UserRepository($pdo);
$sessionRepository = new SessionRepository($pdo);
// Validator
$emailValidator = new EmailValidator();
// services
$userService = new UserService($userRepository, $emailValidator);
$sessionService = new SessionService($userRepository, $sessionRepository);

$request = json_decode(file_get_contents("php://input"));

switch ($request->action) {
    case 'connect':
        $email = $request->email;
        $password = $request->password;
        $result = $sessionService->loginUser($email, $password);
        $response = ['success' => true, 'message' => 'Connection réussie', 'token' => $result]; 
        break;
    case 'checkToken':
        $result = $sessionService->getSessionByToken($request->token);
        $response = ['success' => $result];
        break;
    case 'disconnect':
        $response = $sessionService->deleteSessionByToken($request->token);
        break;
    default:
        $response =['success' => false, 'message' => 'Action non reconnue !'];
        break;
}

echo json_encode($response);

