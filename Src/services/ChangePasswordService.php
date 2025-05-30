<?php

namespace App\Services;
use App\Repositories\UserRepository;

class ChangePasswordService {
    private $repo;

    public function __construct(UserRepository $repo) {
        $this->repo = $repo;
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

