<?php

namespace App\Services;
use App\Repositories\UserRepository;
use App\Services\EmailValidatorService;

class ChangePasswordService {
    private $userRepository;
    private $emailValidator;

    public function __construct(UserRepository $userRepository, EmailValidatorService $emailValidator) {
        $this->userRepository = $userRepository;
        $this->emailValidator = $emailValidator;
    }

    public function changePassword(string $email, string $newPassword): array {
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user) {
            return ["status" => "error", "message" => "Utilisateur non trouvé"];
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $success = $this->userRepository->updatePassword($email, $hashedPassword);

        return $success
            ? ["status" => "success", "message" => "Mot de passe mis à jour"]
            : ["status" => "error", "message" => "Échec de la mise à jour"];
    }
}

