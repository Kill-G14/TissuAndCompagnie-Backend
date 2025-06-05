<?php 

namespace App\Repositories;

class SessionRepository {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createSession(string $token, int $idUser): bool {
        $query = "INSERT INTO sessions (token, idUser) VALUES (:token, :idUser)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':idUser', $idUser);
        return $stmt->execute();
    }

    public function getSessionByToken($token) {
        $query = "SELECT * FROM sessions WHERE token = :token";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateSession($token, $idUser): bool {
        $query = "UPDATE sessions SET idUser = :idUser WHERE token = :token";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':idUser', $idUser);
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