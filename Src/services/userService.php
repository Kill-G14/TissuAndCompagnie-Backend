<?php

namespace App\Services;
use App\Repositories\UserRepository;

class UserService {
    private $repo;
    private $emailValidator;

    public function __construct(UserRepository $repo, EmailValidatorService $emailValidator) {
        $this->repo = $repo;
        $this->emailValidator = $emailValidator;
    }

    public function registerUser($request) {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Email invalide !'];
        }

        if ($this->repo->getUserByEmail($request->email)) {
            return ['success' => false, 'message' => 'L\'email est déjà utilisé !'];
        }

        $password = password_hash($request->password, PASSWORD_DEFAULT);
        $result = $this->repo->createUser($request->userName, $request->email, $password);

        return $result
            ? ['success' => true, 'message' => 'Utilisateur créé avec succès !']
            : ['success' => false, 'message' => 'Erreur lors de la création de l\'utilisateur !'];
    }
    public function loginUser(string $email, string $password): array {
        $user = $this->repo->getUserByEmail($email);
    
        if (!$user) {
            return ['success' => false, 'message' => 'Utilisateur non trouvé.'];
        }
    
        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Mot de passe incorrect.'];
        }
    
        return [
            'success' => true,
            'message' => 'Connexion réussie.',
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'isAdmin' => $user['isAdmin'] ?? false,
            ]
        ];
    }

    public function updateUserInfos($request): array {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Email invalide'];
        }
    
        if (!preg_match('/^\+?\d[\d\s\-]{6,}$/', $request->telephone)) {
            return ['success' => false, 'message' => 'Numéro de téléphone invalide'];
        }
    
        $success = $this->repo->updateUserInfos(
            $request->email,
            $request->adresse,
            $request->adresseLivraison,
            $request->telephone
        );
    
        return $success
            ? ['success' => true, 'message' => 'Coordonnées mises à jour.']
            : ['success' => false, 'message' => 'Échec de la mise à jour.'];
    }
}
