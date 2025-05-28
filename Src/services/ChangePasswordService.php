<?php

require '../db.php';
require '../Repositories/userRepository.php';
require '../Models/User.php';

class ChangeMdpService {
    public function changePassword($email, $newPassword): array {
        $user = new User();

        if (!$user->getUserByEmail($email)) {
            return ["status" => "error", "message" => "Utilisateur non trouvé"];
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $success = $user->updatePassword($email, $hashedPassword);

        if ($success) {
            return ["status" => "success", "message" => "Mot de passe mis à jour"];
        } else {
            return ["status" => "error", "message" => "Échec de la mise à jour"];
        }
    }
}
