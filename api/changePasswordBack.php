<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__.'/../Src/db.php';
require __DIR__.'/../vendor/autoload.php';
// Models
// repositories 
use App\Repositories\UserRepository;
// Validator
// services
use App\Services\ChangePasswordService;
use App\Services\EmailValidatorService;


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
        $response = $changePasswordService->changePassword($email, $newPassword);
        break;
    default:
        echo json_encode(["status" => "error", "message" => "Action invalide"]);
        exit;
}

echo json_encode($response);
