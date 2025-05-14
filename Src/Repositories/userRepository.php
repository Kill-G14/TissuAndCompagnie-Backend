<?php

function createUser(string $userName, string $email, string $password, string $subscriptionDate): bool {
    global $pdo;
    $query = "INSERT INTO users (email, userName, password, subscriptionDate)
              VALUES (:email, :userName, :password, :subscriptionDate)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':userName', $userName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':subscriptionDate', $subscriptionDate);
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