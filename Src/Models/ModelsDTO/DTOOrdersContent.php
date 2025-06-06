<?php
namespace App\Models\ModelsDTO;
class DTOOrdersContent {
    public $id;
    public $idCustomer;
    public $state;
    public $deliveryAddress;
    public $firstName;
    public $lastName;
    public $phone;
    public $email;
    public $orderContent;

    public function __construct($id, $idCustomer, $state, $deliveryAddress, $firstName, $lastName, $phone, $email, $orderContent) {
        $this->id = $id;
        $this->idCustomer = $idCustomer;
        $this->state = $state;
        $this->deliveryAddress = $deliveryAddress;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->email = $email;
        $this->orderContent = $orderContent;
    }
}