<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__.'/../Src/db.php';
require __DIR__.'/../vendor/autoload.php';

use App\Services\ChangePasswordService;
use App\Repositories\UserRepository;


$repo = new UserRepository($pdo);
$service = new ChangePasswordService($repo);
$email = $request["email"] ?? null;
$newPassword = $request["newPassword"] ?? null;
$response = $service->changePassword($email, $newPassword);
$request = json_decode(file_get_contents("php://input"), true);


if (!isset($request["action"]) || $request["action"] !== "changePassword") {
    echo json_encode(["status" => "error", "message" => "Action invalide"]);
    exit;
}


if (!$email || !$newPassword) {
    echo json_encode(["status" => "error", "message" => "Champs manquants"]);
    exit;
}


echo json_encode($response);
