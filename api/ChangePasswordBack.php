<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__.'/../vendor/autoload.php';
// Models
// repositories 
use App\Repositories\UserRepository;
// Validator
// services
use App\Services\ChangePasswordService;
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
$changePasswordService = new ChangePasswordService($userRepository, $emailValidator);

$request = json_decode(file_get_contents("php://input"));

switch ($request->action) {
    case "changePassword":
        $email = $request->email ?? null;
        $newPassword = $request->newPassword ?? null;
        $result = $changePasswordService->changePassword($email, $newPassword);
        $response = ["status" => "success", "message" , "Changement de mot de passe réussi" => $result];
        break;
    default:
        $response = ["status" => "error", "message" => "Action non spécifiée."];
        exit;
}

echo json_encode($response);
