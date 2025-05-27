session_start();

class LogoutService {
    public function logout(): array {
        session_unset();
        session_destroy();

        return [
            "status" => "success",
            "message" => "Déconnexion réussie"
        ];
    }
}