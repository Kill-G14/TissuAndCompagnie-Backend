<?php

class User {
    public $id;
    public $ref;
    public $description;
    public $quantity;
    public $price;
    public $location;
    public $isDeleted;
    public $name;
    public $type;

    public function __construct($id, $ref, $description, $quantity, $price, $location, $isDeleted, $name, $type) {
        $this->id = $id;
        $this->ref = $ref;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->location = $location;
        $this->isDeleted = $isDeleted;
        $this->name = $name;
        $this->type = $type;
    }
}

?>