<?php

class Session {
    public $id;
    public $idUser;
    public $idBasket;
    public $Token;

    public function __construct($id, $idUser, $idBasket, $Token,) {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->idBasket = $idBasket;
        $this->Token = $Token;
    }
}

?>