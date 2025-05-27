<?php

class User {
    public $id;
    public $ref;
    public $type;
    public $description;
    public $quantity;
    public $price;
    public $location;
    public $length;
    public $color;
    public $isDeleted;

    public function __construct($id, $ref, $type, $description, $quantity, $price, $location, $length, $color, $isDeleted) {
        $this->id = $id;
        $this->ref = $ref;
        $this->type = $type;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->location = $location;
        $this->length = $length;
        $this->color = $color;
        $this->isDeleted = $isDeleted;
    }
}

?>