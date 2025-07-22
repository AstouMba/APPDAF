<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\CitoyenController;
use App\Service\CitoyenService;
use App\Repository\CitoyenRepository;

$pdo = new PDO("pgsql:host=db;port=5432;dbname=app_db", "astou", "Astou0000", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$repository = new CitoyenRepository($pdo);
$service = new CitoyenService($repository);

$controller = new CitoyenController($service);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/api/citoyen/cni' && $method === 'GET') {
    $controller->rechercherParCni();
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Route non trouvée.']);
}
