<?php

header("Content-Type: application/json"); // S'assurer que le serveur renvoie du JSON
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");


// Récupération des données envoyées par le client
$request = json_decode(file_get_contents('php://input'));

// Inclusion des fichiers nécessaires
require_once '../Src/services/userService.php';
require '../Src/Repositories/userRepository.php';
require '../Src/Services/emailValidator.php';
require '../Src/db.php';

if ($request === null) {
    echo json_encode(['success' => false, 'message' => 'Aucune donnée reçue ou format invalide']);
    exit;
}

switch ($request->action) {
    case 'registerNewUser':

        // Vérif si l'email est valide 
        if (!checkUserEmail(email: $request->email)) {
            echo json_encode(['success' => false, 'message' => 'Email invalide !']);
            exit;
        }

        // Vérif si l'email est déjà utilisé
        $existingUser = getUserByEmail($request->email); // Assurez-vous de créer cette fonction dans `inscriptionBack.php`
        if ($existingUser) {
            echo json_encode(['success' => false, 'message' => 'L\'email est déjà utilisé !']);
            exit;
        }

        // Hachage du mot de passe
        $password = password_hash($request->password, PASSWORD_DEFAULT);

        // Défini un avatar 
        $avatar = '';  // 

        // Crée l'utilisateur
        $result = createUser($request->userName, $request->email, $avatar, $password, $subscriptionDate);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Utilisateur créé avec succès !']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la création de l\'utilisateur !']);
        }
        break;

   case 'connect':
        // Gérer la logique de connexion ici plus tard
       break;

    default:
        echo json_encode(['success' => false, 'message' => 'Action non reconnue !']);
        break;
}

?>