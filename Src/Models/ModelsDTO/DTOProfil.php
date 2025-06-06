<?php 

namespace App\Models\ModelsDTO;

class DTOProfil
{
    public $user;
    public $customer;
    public $adress;
    public $ordres;

    public function __construct($user, $customer, $adress, $ordres) {
        $this->user = $user;
        $this->customer = $customer;
        $this->adress = $adress;
        $this->ordres = $ordres;
    }
}