<?php

class ProductsService {
    private $repo;

    public function __construct(ProductsRepository $repo) {
        $this->repo = $repo;
    }

    public function getPaginatedProducts(string $type, int $page, int $perPage = 28): array {
        $offset = ($page - 1) * $perPage;
        $products = $this->repo->findProductsByType($type, $perPage, $offset);
        $total = $this->repo->countProductsByType($type);
        $totalPages = ceil($total / $perPage);

        return [
            'products' => $products,
            'pagination' => [
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'totalItems' => $total,
                'perPage' => $perPage
            ]
        ];
    }
}
