<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__.'/../vendor/autoload.php';
// Models
// repositories 
use App\Repositories\UserRepository;
// Validator
// services
use App\Services\UserService;
use App\Services\EmailValidatorService;
use App\Services\DBConnexion;


$DBConnexion = new DBConnexion();
$pdo = $DBConnexion->getDB();



// Models
// repositories 
$userRepository = new UserRepository($pdo);
// Validator
$emailValidator = new EmailValidatorService();
// services
$userService = new UserService($userRepository, $emailValidator);

$request = json_decode(file_get_contents('php://input'));


switch ($request->action) {
    case 'registerNewUser':
        $result = $userService->registerUser($request);
        $response = ['success' => true, 'message' => 'inscription réussie', 'result' => $result];
        break;

    default:
        $response = ['success' => false, 'message' => 'Champ non valide'];
        break;
}

echo json_encode($response);