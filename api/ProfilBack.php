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

switch ($request->action) {
    case "updateUserInfos":
        $adresse = $request->adresse;
        $adresseLivraison = $request->adresseLivraison;
        $telephone = $request->telephone;
        $email = $request->email;
        $result = $userService->updateUserInfos($request);
        $response = ['success' => true, 'message' => $result['message']];
        break;   
    default:
        $response = ['success' => false, 'message' => 'Action non prise en charge.'];
        break;
}

echo json_encode($response);
