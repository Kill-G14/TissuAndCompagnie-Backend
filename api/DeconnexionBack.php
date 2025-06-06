<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

require __DIR__ . '/../Src/db.php';
require __DIR__ . '/../vendor/autoload.php';

// Models
// repositories 
use App\Repositories\SessionRepository;
// Validator
// services
use App\Services\SessionService;

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