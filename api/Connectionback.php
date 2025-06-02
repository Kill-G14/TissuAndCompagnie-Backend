<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

require __DIR__ . '/../Src/db.php';
require __DIR__ . '/../vendor/autoload.php';

use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Services\EmailValidatorService;

$request = json_decode(file_get_contents("php://input"));
$email = $request->email ?? null;
$password = $request->password ?? null;
$repo = new UserRepository($pdo);
$emailValidator = new EmailValidatorService();
$service = new UserService($repo, $emailValidator);

if (!$request || !isset($request->action) || $request->action !== 'connect') {
    echo json_encode(['success' => false, 'message' => 'Action invalide ou non spécifiée']);
    exit;
}

if (!$email || !$password) {
    echo json_encode(['success' => false, 'message' => 'Champs requis manquants.']);
    exit;
}

$response = $service->loginUser($email, $password);
echo json_encode($response);

