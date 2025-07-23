<?php
namespace App\Controller;

use App\Service\CitoyenService;
use App\Core\abstract\AbstractController;
use App\Entity\Response;
use App\Entity\StatutEnum;

class CitoyenController extends AbstractController
{
    private CitoyenService $citoyenService;

    public function __construct(CitoyenService $citoyenService)
    {
        $this->citoyenService = $citoyenService;
    }

    public function rechercherParCni(): void
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $cni = $input['cni'] ?? null;

        if (!$cni) {
            $response = new Response(
                null,
                StatutEnum::ERROR,
                400,
                'Le champ CNI est requis'
            );
            $this->renderJson($response);
            return;
        }

        $citoyen = $this->citoyenService->rechercherParCni($cni);

        if ($citoyen) {
            

            $response = new Response(
                $citoyen,
                StatutEnum::SUCCES,
                200,
                "Le numéro de carte d'identité a été retrouvé"
            );

        } else {
            $response = new Response(
                null,
                StatutEnum::ERROR,
                404,
                "Le numéro de carte d'identité non retrouvé"
            );
        }

        $this->renderJson($response);
    }

    public function show(): void {}
}
