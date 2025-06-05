<?php
namespace App\Models;
class Picture {
    public $id;
    public $productId;
    public $fileName;
    public $isDeleted;


    public function __construct($id, $productId, $fileName, $isDeleted) {
        $this->id = $id;
        $this->productId = $productId;
        $this->fileName = $fileName;
        $this->isDeleted = $isDeleted;
    }
}
