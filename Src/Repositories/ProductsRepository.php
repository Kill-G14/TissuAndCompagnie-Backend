<?php

class ProductsRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findProductsByType(string $type, int $limit, int $offset): array {
        $type = strtolower($type);

        switch ($type) {
            case 'button':
                $stmt = $this->pdo->prepare("SELECT * FROM buttons WHERE isDeleted = 0 LIMIT :limit OFFSET :offset");
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                return array_map(fn($row) => new Product_button(...array_values($row)), $stmt->fetchAll(PDO::FETCH_ASSOC));

            case 'cloth':
                $stmt = $this->pdo->prepare("SELECT * FROM cloths WHERE isDeleted = 0 LIMIT :limit OFFSET :offset");
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                return array_map(fn($row) => new Product_cloth(...array_values($row)), $stmt->fetchAll(PDO::FETCH_ASSOC));

            case 'zip':
                $stmt = $this->pdo->prepare("SELECT * FROM zips WHERE isDeleted = 0 LIMIT :limit OFFSET :offset");
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                return array_map(fn($row) => new Product_zip(...array_values($row)), $stmt->fetchAll(PDO::FETCH_ASSOC));

            case 'other':
                $stmt = $this->pdo->prepare("SELECT * FROM others WHERE isDeleted = 0 LIMIT :limit OFFSET :offset");
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                return array_map(fn($row) => new Product_other(...array_values($row)), $stmt->fetchAll(PDO::FETCH_ASSOC));

            default:
                return [];
        }
    }

    public function countProductsByType(string $type): int {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM {$type}s WHERE isDeleted = 0");
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
}
