<?php
use App\Controller\CitoyenController;



return $routes = [
    '/api/citoyen/cni' => [
        'controller' => CitoyenController::class,
        'action' => 'rechercherParCni'
    ],
];