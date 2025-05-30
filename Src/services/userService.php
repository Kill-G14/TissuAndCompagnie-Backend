<?php

namespace App\Services;
use App\Repositories\UserRepository;

class UserService {
    private $repo;

    public function __construct(UserRepository $repo) {
        $this->repo = $repo;
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
}
