<?php

namespace App\Services;
use App\Repositories\UserRepository;

class SessionService {
    private $userRepository;

    public function __construct( UserRepository $userRepository) {
        $this->userRepository = $userRepository;   
    }
    public function loginUser(string $email, string $password): bool|string {
        $user = $this->userRepository->getUserByEmail($email);
    
        if (!$user) {
            return false;
        }
    
        if (!password_verify($password, $user['password'])) {
            return false;
        }

        //Créer un token de session de 16 caractéres
        //inseret en base de donnée le token et l'id de l'utilisateur en utilisant le SessionRepository
        //Si la session est bien créer on renvoie le token
    }
}