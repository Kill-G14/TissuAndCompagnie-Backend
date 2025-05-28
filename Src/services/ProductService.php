<?php

class ProductsService {
    private $repo;

    public function __construct(ProductsRepository $repo) {
        $this->repo = $repo;
    }

    public function getPaginatedProducts(string $type, int $page, int $perPage = 28): array {
        $offset = ($page - 1) * $perPage;
        $products = $this->repo->findProductsByType($type, $perPage, $offset);
        $DTOproducts = [];
        foreach ($products as $product) {
            $productId = $product->id ?? null;

            if ($productId !== null) {
                $pictures = $this->repo->findImagesByProductId($productId);
            } else {
                $pictures = [];
            }

            $DTOproducts[] = new DTOProducts($product, $pictures);
        }

        $numberOFProducts = $this->repo->countProductsByType($type);
        $totalPages = ceil($numberOFProducts / $perPage);

        return [
            'products' => $products,
            'pagination' => ['currentPage' => $page,'totalPages' => $totalPages,'totalItems' => $numberOFProducts,'perPage' => $perPage]
        ];
    }
}
