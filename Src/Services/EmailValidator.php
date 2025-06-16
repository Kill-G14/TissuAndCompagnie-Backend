<?php

namespace App\Services;


class EmailValidator {

    public function __construct() {

    }


    public function checkUserEmail(string $email): bool {
        $regex = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+[.]+[a-zA-Z]{2,4}$/';
        $result = preg_match($regex, $email);
        if ($result === 0) {
            return false;
        } else {
            return true;
        }
     }
}
