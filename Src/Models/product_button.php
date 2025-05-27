<?php

class User {
    public $id;
    public $ref;
    public $description;
    public $quantity;
    public $price;
    public $location;
    public $material;
    public $diameter;
    public $color;
    public $isDeleted;
    public $hole;

    public function __construct($id, $ref, $description, $quantity, $price, $location, $material, $diameter, $color, $isDeleted, $hole) {
        $this->id = $id;
        $this->ref = $ref;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->location = $location;
        $this->material = $material;
        $this->diameter = $diameter;
        $this->color = $color;
        $this->isDeleted = $isDeleted;
        $this->hole = $hole;
    }
}

?>