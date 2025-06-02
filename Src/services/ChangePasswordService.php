<?php

namespace App\Services;
use App\Repositories\UserRepository;

class ChangePasswordService {
    private $repo;
    private $emailValidator;

    public function __construct(UserRepository $repo, EmailValidatorService $emailValidator) {
        $this->repo = $repo;
        $this->emailValidator = $emailValidator;
    }

    public function changePassword(string $email, string $newPassword): array {
        $user = $this->repo->getUserByEmail($email);

        if (!$user) {
            return ["status" => "error", "message" => "Utilisateur non trouvé"];
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $success = $this->repo->updatePassword($email, $hashedPassword);

        return $success
            ? ["status" => "success", "message" => "Mot de passe mis à jour"]
            : ["status" => "error", "message" => "Échec de la mise à jour"];
    }
}

