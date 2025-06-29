<?php
namespace App\Repositories;


class UserRepository {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getUserByEmail(string $email): array {
        $query = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user ?: [];
    }

    public function createUser(string $name, string $email, string $password): bool {
        $query = "INSERT INTO user (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }

    public function updatePassword(string $email, string $hashedPassword): bool {
        $query = "UPDATE user SET password = :password WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function updateUserInfos(string $email, string $adresse, string $adresseLivraison, string $telephone): bool {
        $query = "UPDATE user SET adresse = :adresse, adresse_livraison = :adresseLivraison, telephone = :telephone WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':adresseLivraison', $adresseLivraison);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function getUserById(int $id): string|array {
        $query = "SELECT * FROM user WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user ?:[];
    }
}
