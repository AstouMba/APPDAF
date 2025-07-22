<?php
namespace App\Service;

use App\Repository\CitoyenRepository;
use App\Entity\Citoyen;

class CitoyenService
{
    private CitoyenRepository $citoyenRepository;

    public function __construct(CitoyenRepository $citoyenRepository)
    {
        $this->citoyenRepository = $citoyenRepository;
    }

    public function rechercherParCni(string $cni): ?Citoyen
    {
        return $this->citoyenRepository->selectByCni($cni);
    }


}
