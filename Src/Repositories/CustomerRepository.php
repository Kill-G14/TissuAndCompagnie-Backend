<?

namespace App\Repositories;

use App\Models\Customer;
// class CustomerRepository {
//     private $pdo;
//     public function __construct($pdo) {
//         $this->pdo = $pdo;
//     }

//     public function createCustomer($id, $idUser, $email, $password, $firstName, $lastName, $phone, $isDeleted) {
//         $query = "INSERT INTO customer (id, idUser, email, password, firstName, lastName, phone, isDeleted) VALUES (:id, :idUser, :email, :password, :firstName, :lastName, :phone, :isDeleted)";
//         $stmt = $this->pdo->prepare($query);
//         $stmt->bindParam(':id', $id);
//         $stmt->bindParam(':idUser', $idUser);
//         $stmt->bindParam(':email', $email);
//         $stmt->bindParam(':password', $password);
//         $stmt->bindParam(':firstName', $firstName);
//         $stmt->bindParam(':lastName', $lastName);
//         $stmt->bindParam(':phone', $phone);
//         $stmt->bindParam(':isDeleted', $isDeleted);
//         return $stmt->execute();
//     }

//     public function updateCustomerPassword($email, $hashedPassword) {
//         $query = "UPDATE customer SET password = :password WHERE email = :email";
//         $stmt = $this->pdo->prepare($query);
//         $stmt->bindParam(':password', $hashedPassword);
//         $stmt->bindParam(':email', $email);
//         if ($stmt->execute()) {
//             return true;
//         } else {
//             return false;
//     }
//     }

//     public function getCustomerById($id) {
//         $query = "SELECT * FROM customer WHERE id = :id";
//         $stmt = $this->pdo->prepare($query);
//         $stmt->bindParam(':id', $id);
//         $stmt->execute();
//         $customer = $stmt->fetch(\PDO::FETCH_ASSOC);
//         return $customer ?: null;
//     }
// }