<?php
header(header: "Access-Control-Allow-Origin: *");
header(header: "Access-Control-Allow-Methods: GET, POST, OPTIONS");
header(header: "Access-Control-Allow-Headers: Content-Type");

require_once '../Src/services/Tools.php';
require_once '../Src/services/ChangeMdpService.php';
require_once '../Src/db.php';
require_once '../Src/models/User.php';

$request = json_decode(file_get_contents("php://input"), true);

if (!isset($request["action"]) || $request["action"] !== "changePassword") {
    echo json_encode(["status" => "error", "message" => "Action invalide"]);
    exit;
}

$email = $data["email"] ?? null;
$newPassword = $data["newPassword"] ?? null;

if (!$email || !$newPassword) {
    echo json_encode(["status" => "error", "message" => "Champs manquants"]);
    exit;
}

$service = new ChangeMdpService();
$response = $service->changePassword($email, $newPassword);

echo json_encode($response);
