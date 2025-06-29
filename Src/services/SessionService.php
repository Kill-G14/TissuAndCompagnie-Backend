<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\SessionRepository;

class SessionService {
    private $userRepository;
    private $sessionRepository;

    public function __construct(UserRepository $userRepository, SessionRepository $sessionRepository) {
        $this->userRepository = $userRepository;
        $this->sessionRepository = $sessionRepository;
    }

    public function getSessionByToken(string $token): bool {
        $session = $this->sessionRepository->getSessionByToken($token);
        return $session ? true : false; 
        // On retourne le resultat du if (?) qui si il est vide est false et si il est remplie est true
        /*
        if ($session) {
            return true;
        } else {
            return false;
        }
         */
    }

    public function loginUser(string $email, string $password): bool|string {
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        // Generation d’un token de session unique de 16 caracteres
        $token = bin2hex(random_bytes(8));

        $created = $this->sessionRepository->createSession($token, $user['id']);

        return $created ? $token : false;
    }

    public function deleteSessionByToken(string $token): bool {
        $session = $this->sessionRepository->getSessionByToken($token);
        return $session ? $this->sessionRepository->deleteSessionByToken($session['id']) : false;
    }
}
