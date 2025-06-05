<?php
namespace App\Models;
class Customer {
    public $id;
    public$idUser;
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    public $phone;
    public $isDeleted;

    public function __construct($id, $idUser, $email, $password, $firstName, $lastName, $phone, $isDeleted) {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->isDeleted = $isDeleted;
    }
}

