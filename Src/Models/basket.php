<?php

class Basket {
    public $id;
    public $idOrders_content;

    public function __construct( $id, $idOrders_content) {
        $this->id = $id;
        $this->idOrders_content = $idOrders_content;
    }

}

?>