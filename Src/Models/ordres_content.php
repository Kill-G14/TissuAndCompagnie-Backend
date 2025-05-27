<?php

class User {
    public $id;
    public $orderId;
    public $productId;
    public $productCategories;
    public $quantity;
    public $price;
    public $isPrepared;
    public $isDeleted;

    public function __construct($id, $orderId, $productId, $productCategories, $quantity, $price, $isPrepared, $isDeleted) {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->productCategories = $productCategories;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->isPrepared = $isPrepared;
        $this->isDeleted = $isDeleted;
    }
}

?>