<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__ . '/../Src/db.php';
require __DIR__ . '/../vendor/autoload.php';
// Models
// repositories 
use App\Repositories\ProfilRepository;
// Validator
// services
use App\Services\ProfilService;


// Models
// repositories 
$profilRepository = new ProfilRepository($pdo);
// Validator
// services
$profilService = new ProfilService($profilRepository);

$request = json_decode(file_get_contents("php://input"));

switch ($request->action) {
    case "getUserInfos":
        $email = $request->email;
        $result = $profilService->
        $response = ['success' => true, 'data' => $result];
        break;
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
