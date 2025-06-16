<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__ . '/../vendor/autoload.php';

// Models
// repositories 
use App\Repositories\SessionRepository;
// Validator
// services
use App\Services\SessionService;
use App\Services\DBConnexion;


$DBConnexion = new DBConnexion();
$pdo = $DBConnexion->getDB();



// Models
// repositories 
$sessionRepository = new SessionRepository($pdo);
// Validator
// services
$sessionService = new SessionService($userRepository, $sessionRepository);

$request = json_decode(file_get_contents("php://input"));

switch ($request->action) {
    case 'disconnect':
        $token = $request->token ?? null;
        $result = $sessionService->deleteSessionByToken($token);
        $response = ['success' => true, 'message' => 'Deconnexion réussie']; 
        break;

    default:
        $response =['success' => false, 'message' => 'Action non reconnue !'];
        break;
}

echo json_encode($response);