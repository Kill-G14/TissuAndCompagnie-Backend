<?php
namespace App\Models\ModelsDTO;
class DTOProducts {
    public mixed $product;
    public array $pictures;

    public function __construct( $product, $pictures) {
        $this->product = $product;
        $this->pictures = $pictures;
    }
}
