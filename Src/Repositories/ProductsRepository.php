<?php

class ProductsRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findProductsByType(string $categories,int $limit, int $offset): array {
        $categories = strtolower($categories);

        $stmt = $this->pdo->prepare("SELECT * FROM products_{$categories} WHERE isDeleted = 0 LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            switch ($categories) {
                case 'button':
                    $products[] = new Product_button(...array_values($row));
                    break;
                case 'cloth':
                    $products[] = new Product_cloth(...array_values($row));
                    break;
                case 'zip':
                    $products[] = new Product_zip(...array_values($row));
                    break;
                case 'other':
                    $products[] = new Product_other(...array_values($row));
                    break;
            }
        }
        return $products;
    }

    public function countProductsByType(string $categories): int {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM {$categories}s WHERE isDeleted = 0");
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
}


// switch ($Categories) {
//     case 'button':
//         $stmt = $this->pdo->prepare("SELECT * FROM button WHERE isDeleted = 0 LIMIT :limit OFFSET :offset");
//         $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
//         $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
//         $stmt->execute();
//         return array_map(fn($row) => new Product_button(...array_values($row)), $stmt->fetchAll(PDO::FETCH_ASSOC));

//     case 'cloth':
//         $stmt = $this->pdo->prepare("SELECT * FROM cloth WHERE isDeleted = 0 LIMIT :limit OFFSET :offset");
//         $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
//         $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
//         $stmt->execute();
//         return array_map(fn($row) => new Product_cloth(...array_values($row)), $stmt->fetchAll(PDO::FETCH_ASSOC));

//     case 'zip':
//         $stmt = $this->pdo->prepare("SELECT * FROM zip WHERE isDeleted = 0 LIMIT :limit OFFSET :offset");
//         $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
//         $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
//         $stmt->execute();
//         return array_map(fn($row) => new Product_zip(...array_values($row)), $stmt->fetchAll(PDO::FETCH_ASSOC));

//     case 'other':
//         $stmt = $this->pdo->prepare("SELECT * FROM other WHERE isDeleted = 0 LIMIT :limit OFFSET :offset");
//         $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
//         $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
//         $stmt->execute();
//         return array_map(fn($row) => new Product_other(...array_values($row)), $stmt->fetchAll(PDO::FETCH_ASSOC));

//     default:
//         return [];
// }