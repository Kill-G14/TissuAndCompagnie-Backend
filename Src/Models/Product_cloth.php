<?php
namespace App\Models;
class Product_cloth{
    public $id;
    public $ref;
    public $type;
    public $description;
    public $quantity;
    public $price;
    public $location;
    public $material;
    public $width;
    public $color;
    public $isDeleted;

    public function __construct($id, $ref, $type, $description, $quantity, $price, $location, $material, $width, $color, $isDeleted) {
        $this->id = $id;
        $this->ref = $ref;
        $this->type = $type;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->location = $location;
        $this->material = $material;
        $this->width = $width;
        $this->color = $color;
        $this->isDeleted = $isDeleted;
    }
}
