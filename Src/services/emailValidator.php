<?php
namespace App\Services;

class EmailValidator {
    public function checkUserEmail(string $email): bool {
        $regex = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+[.]+[a-zA-Z]{2,4}$/';
        return preg_match($regex, $email) === 1;
    }
}
