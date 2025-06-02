<?php
namespace App\Repositories;


class UserRepository {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

/*************  ✨ Windsurf Command ⭐  *************/
/*******  2c0fe598-062a-445d-a5a5-c8e01d46cdc2  *******/
    public function getUserByEmail(string $email): array {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function createUser(string $name, string $email, string $password): bool {
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }

    public function updatePassword(string $email, string $hashedPassword): bool {
        $query = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function updateUserInfos(string $email, string $adresse, string $adresseLivraison, string $telephone): bool {
        $query = "UPDATE users SET adresse = :adresse, adresse_livraison = :adresseLivraison, telephone = :telephone WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':adresseLivraison', $adresseLivraison);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}
