<?php 

namespace App\Services;

use App\Repositories\ProfilRepository;
use App\Models\ModelsDTO\DTOProfil;

class ProfilService{
    private $profilRepository;

    public function __construct(ProfilRepository $profilRepository) {
        $this->profilRepository = $profilRepository;
    }

    public function getProfil($idUser) {
        $user = $this->profilRepository->getUser($idUser);
        $customer = $this->profilRepository->getCustomer($idUser);
        $adress = $this->profilRepository->getAdress($idUser);
        $ordres = $this->profilRepository->getOrdres($idUser);
        $dtoProfil = new DTOProfil($user, $customer, $adress, $ordres);
        return $dtoProfil;
    }
}

