<?php
namespace App\Repositories;
use App\Models\Basket;
use App\Models\Session;

class BasketRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addProductToBasket($userId, $productId, $quantity) {
        $stmt = $this->pdo->prepare("INSERT INTO basket (userId, productId, quantity) VALUES (:userId, :productId, :quantity)");
        $stmt->execute(['userId' => $userId, 'productId' => $productId, 'quantity' => $quantity]);
        return $this->pdo->lastInsertId();
    }

    public function getBasketByUserId($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM basket WHERE userId = :userId");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteProductFromBasket($userId, $productId) {
        $stmt = $this->pdo->prepare("DELETE FROM basket WHERE userId = :userId AND productId = :productId");
        $stmt->execute(['userId' => $userId, 'productId' => $productId]);
    }

    public function updateProductQuantity($userId, $productId, $quantity) {
        $stmt = $this->pdo->prepare("UPDATE basket SET quantity = :quantity WHERE userId = :userId AND productId = :productId");
        $stmt->execute(['quantity' => $quantity, 'userId' => $userId, 'productId' => $productId]);
    }

    public function clearBasket($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM basket WHERE userId = :userId");
        $stmt->execute(['userId' => $userId]);
    }

    public function deleteProduct($productId) {
        $stmt = $this->pdo->prepare("DELETE FROM basket WHERE productId = :productId");
        $stmt->execute(['productId' => $productId]);
    }
}