<?php
namespace App\Services;
use App\Repositories\ProductsRepository;
use App\Models\ModelsDTO\DTOProduct;
class ProductsService {
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository) {
        $this->productsRepository = $productsRepository;
    }

    public function getPaginatedProducts(string $type, int $page, int $perPage = 28): array {
        $offset = ($page - 1) * $perPage;
        $products = $this->productsRepository->findProductsByType($type, $perPage, $offset);
        $DTOproducts = [];
        foreach ($products as $product) {
            $productId = $product->id;
            $pictures = [];
            if ($productId !== null) {
                $pictures = $this->productsRepository->findImagesByProductId($productId);
            }
            $DTOproducts[] = new DTOProduct($product, $pictures);
        }

        $numberOFProducts = $this->productsRepository->countProductsByType($type);
        $totalPages = ceil($numberOFProducts / $perPage);

        return [
            'products' => $DTOproducts,
            'pagination' => ['currentPage' => $page,'totalPages' => $totalPages,'totalItems' => $numberOFProducts,'perPage' => $perPage]
        ];
    }
}
