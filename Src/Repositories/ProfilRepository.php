<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Adress;
use App\Models\Customer;
use App\Models\Ordres;

class ProfilRepository {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getUser($idUser) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->execute(['id' => $idUser]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }

    public function getAdress($idAddress) {
        $stmt = $this->pdo->prepare("SELECT * FROM adresse WHERE idCustomer = :idCustomer");
        $stmt->execute(['idCustomer' => $idAddress]);
        $userAddress = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $userAddress;
    }

    public function getOrdres($idOrdres) {
        $stmt = $this->pdo->prepare("SELECT * FROM ordres WHERE idCustomer = :idCustomer");
        $stmt->execute(['idCustomer' => $idOrdres]);
        $userOrdres = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $userOrdres;
    }

    public function getCustomer($idCustomer) {
        $stmt = $this->pdo->prepare("SELECT * FROM customer WHERE id = :id");
        $stmt->execute(['id' => $idCustomer]);
        $userCustomer = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $userCustomer;
    }



}