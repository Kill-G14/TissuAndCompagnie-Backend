<?php 

namespace App\Repositories;

use App\Models\ModelsDTO\DTOUserAdress;

class AdresseRepository {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createAdress($id, $idCustomer, $Type, $address) {
        $stmt = $this->pdo->prepare("INSERT INTO adresse (id, idCustomer, Type, address) VALUES (:id, :idCustomer, :Type, :address)");
        $stmt->execute(['id' => $id, 'idCustomer' => $idCustomer, 'Type' => $Type, 'address' => $address]);
        return $this->pdo->lastInsertId();
    }

    public function getAdress($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM adresse WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateAdress($id, $idCustomer, $Type, $address) {
        $stmt = $this->pdo->prepare("UPDATE adresse SET idCustomer = :idCustomer, Type = :Type, address = :address WHERE id = :id");
        $stmt->execute(['id' => $id, 'idCustomer' => $idCustomer, 'Type' => $Type, 'address' => $address]);
    }

    public function deleteAdress($id) {
        $stmt = $this->pdo->prepare("DELETE FROM adresse WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

}