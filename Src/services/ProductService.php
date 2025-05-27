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
            // Récupérer les images associées au produit 
            // on crée un DTO qui contient le produit et ses images
            // puis on ajoute le DTO au tableau $DTOproducts
            // je dois faire Un Crud dans le Repository
        }

        $numberOFProducts = $this->repo->countProductsByType($type);
        $totalPages = ceil($numberOFProducts / $perPage);

        return [
            'products' => $products,
            'pagination' => ['currentPage' => $page,'totalPages' => $totalPages,'totalItems' => $numberOFProducts,'perPage' => $perPage]
        ];
    }
}
