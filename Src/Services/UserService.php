<?php

namespace App\Services;
use App\Repositories\UserRepository;
use App\Services\EmailValidator;

class UserService {
    private $userRepository;
    private $emailValidator;

    private $sessionRepository;

    public function __construct(UserRepository $userRepository, EmailValidator $emailValidator) {
        $this->userRepository = $userRepository;
        $this->emailValidator = $emailValidator;
    }

    public function registerUser($email, $name, $password): array {
        if (!filter_var($email->email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Email invalide !'];
        }

        if ($this->userRepository->getUserByEmail($email->email)) {
            return ['success' => false, 'message' => 'L\'email est déjà utilisé !'];
        }

        $password = password_hash($password->password, PASSWORD_DEFAULT);
        $result = $this->userRepository->createUser($name->Name, $email->email, $password);

        return $result
            ? ['success' => true, 'message' => 'Utilisateur créé avec succès !']
            : ['success' => false, 'message' => 'Erreur lors de la création de l\'utilisateur !'];
    }


    public function updateUserInfos($request): array {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Email invalide'];
        }
    
        if (!preg_match('/^\+?\d[\d\s\-]{6,}$/', $request->telephone)) {
            return ['success' => false, 'message' => 'Numéro de téléphone invalide'];
        }
    
        $success = $this->userRepository->updateUserInfos(
            $request->email,
            $request->adresse,
            $request->adresseLivraison,
            $request->telephone
        );
    
        return $success
            ? ['success' => true, 'message' => 'Coordonnées mises à jour.']
            : ['success' => false, 'message' => 'Échec de la mise à jour.'];
    }

    public function getUserByToken($token): array|bool {
        $session = $this->sessionRepository->getSessionByToken($token);
        if (!$session) {
            return false;
        }
        return $this->userRepository->getUserById($session['user']);
    }
}
  
