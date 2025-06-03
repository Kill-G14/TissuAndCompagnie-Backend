<?php 

namespace App\Repositories;
use App\Services\SessionService;

class SessionRepository {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createSession(string $token, int $userId): bool {
        $query = "INSERT INTO sessions (token, userId) VALUES (:token, :userId)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':userId', $userId);
        return $stmt->execute();
    }

    public function getSessionByToken($token) {
        $query = "SELECT * FROM sessions WHERE token = :token";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateSession($token, $userId): bool {
        $query = "UPDATE sessions SET userId = :userId WHERE token = :token";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':token', $token);
        return $stmt->execute();
    }

    public function deleteSessionByToken($token): bool {
        $query = "DELETE FROM sessions WHERE token = :token";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':token', $token);
        return $stmt->execute();   
    }

}