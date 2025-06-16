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
use App\Services\EmailValidator;
use App\Services\DBConnexion;


$DBConnexion = new DBConnexion();
$pdo = $DBConnexion->getDB();



// Models
// repositories 
$userRepository = new UserRepository($pdo);
// Validator
$emailValidator = new EmailValidator();
// services
$userService = new UserService($userRepository, $emailValidator);

$request = json_decode(file_get_contents('php://input'));


switch ($request->action) {
    case 'registerNewUser':
        $email = $request->email;
        $name = $request->name;
        $password = $request->password;
        $result = $userService->registerUser($email,$name ,$password);
        $response = $result;
        break;
    default:
        $response = ['Erreur' => false, 'message' => 'Action non trouvée !'];
        exit;
}

echo json_encode($response);