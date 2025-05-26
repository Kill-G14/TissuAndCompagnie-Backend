<?php

function createUser(string $Name, string $email, string $password, string $subscriptionDate): bool {
    global $pdo;
    $query = "INSERT INTO users (email, Name, password)
              VALUES (:email, :Name, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':Name', $userName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    return $stmt->execute();
}

function getUserByEmail(string $email) {
    global $pdo;
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>