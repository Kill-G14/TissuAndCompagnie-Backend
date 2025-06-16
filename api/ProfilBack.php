<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__ . '/../vendor/autoload.php';
// Models
// repositories 
use App\Repositories\UserRepository;
use App\Repositories\ProfilRepository;
// Validator
// services
use App\Services\DBConnexion;
use App\Services\ProfilService;
use App\Services\UserService;


$DBConnexion = new DBConnexion();
$pdo = $DBConnexion->getDB();



// Models
// repositories 
$userRepository = new UserRepository($pdo);
$profilRepository = new ProfilRepository($pdo);
// Validator
// services
$profilService = new ProfilService($profilRepository);
$userService = new UserService($userRepository, $emailValidator);

$request = json_decode(file_get_contents("php://input"));

switch ($request->action) {
    case 'getUserInfos':
        $token = $request->token;
        $user = $userService->getUserByToken($token);
        if ($user) {
            $response = ['success' => true, 'message' => 'Profil chargé', 'user' => $user];
        } else {
            $response = ['success' => false, 'message' => 'Profil non chargé'];
        }
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
