<?php

class User {
    public $id;
    public $email;
    public $name;
    public $password;
    public $isDeleted;
    public $isAdmin;

    public function __construct($id, $email, $Name, $password, $isDeleted, $isAdmin) {
        $this->id = $id;
        $this->email = $email;
        $this->name = $Name;
        $this->password = $password;
        $this->isDeleted = $isDeleted;
        $this->isAdmin = $isAdmin;
    }
}

?>