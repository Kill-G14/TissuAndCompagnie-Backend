<?php
namespace App\Models;
class Ordres {
    public $id;
    public $idCustomer;
    public $state;
    public $deliveryAddress;
    public $firstName;
    public $lastName;
    public $phone;
    public $email;
    public $isDeleted;

    public function __construct($id, $idCustomer, $state, $deliveryAddress, $firstName, $lastName, $phone, $email, $isDeleted) {
        $this->id = $id;
        $this->idCustomer = $idCustomer;
        $this->state = $state;
        $this->deliveryAddress = $deliveryAddress;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->email = $email;
        $this->isDeleted = $isDeleted;
    }
}
