<?php 

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function create(Customer $customer ): bool {
        $query = "INSERT INTO customer (idUser, email, password, firstName, lastName, phone, isDeleted) VALUES (:idUser, :email, :password, :firstName, :lastName, :phone, :isDeleted)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':idUser', $customer->idUser);
        $stmt->bindParam(':email', $customer->email);
        $stmt->bindParam(':password', $customer->password);
        $stmt->bindParam(':firstName', $customer->firstName);
        $stmt->bindParam(':lastName', $customer->lastName);
        $stmt->bindParam(':phone', $customer->phone);
        $stmt->bindParam(':isDeleted', $customer->isDeleted);
        return $stmt->execute();
    }

    public function getCustomer($idCustomer) {
        $stmt = $this->pdo->prepare("SELECT * FROM customer WHERE id = :idCustomer");
        $stmt->execute(['idCustomer' => $idCustomer]); 
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateCustomer($id, $email, $password, $firstName, $lastName, $phone, $isDeleted) {
        $stmt = $this->pdo->prepare("UPDATE customer SET email = :email, password = :password, firstName = :firstName, lastName = :lastName, phone = :phone, isDeleted = :isDeleted WHERE id = :id");
        $stmt->execute(['id' => $id, 'email' => $email, 'password' => $password, 'firstName' => $firstName, 'lastName' => $lastName, 'phone' => $phone, 'isDeleted' => $isDeleted]); 
    }

    public function deleteCustomer($id) {
        $stmt = $this->pdo->prepare("UPDATE customer SET isDeleted = 1 WHERE id = :id");
        $stmt->execute(['id' => $id]); 
    }
}