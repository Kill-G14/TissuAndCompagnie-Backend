<?php

class User {
    public $id;
    public $idCustomer;
    public $Type;
    public $address;

    public function __construct($id, $idCustomer, $Type, $address) {
        $this->id = $id;
        $this->idCustomer = $idCustomer;
        $this->Type = $Type;
        $this->address = $address;
    }

}

?>