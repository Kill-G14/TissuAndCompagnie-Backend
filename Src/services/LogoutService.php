<?php
namespace App\Services;

use App\Repositories\SessionRepository;


class LogoutService {
    private $sessionRepository;

    public function __construct( SessionRepository $sessionRepository) {
        $this->sessionRepository = $sessionRepository;
    }

    public function deleteSessionByToken($token) {
        return $this->sessionRepository->deleteSessionByToken($token);
    }
}