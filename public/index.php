<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\CitoyenController;
use App\Service\CitoyenService;
use App\Repository\CitoyenRepository;

// Récupération des variables d’environnement
$host = getenv('DB_HOST') ;         
$port = getenv('DB_PORT') ;
$db   = getenv('DB_NAME') ;
$user = getenv('DB_USER') ;
$pass = getenv('DB_PASSWORD') ;

$dsn = "pgsql:host=$host;port=$port;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de connexion à la base de données', 'details' => $e->getMessage()]);
    exit;
}

$repository = new CitoyenRepository($pdo);
$service = new CitoyenService($repository);
$controller = new CitoyenController($service);

// Routage simple
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/api/citoyen/cni' && $method === 'GET') {
    $controller->rechercherParCni();
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Route non trouvée.']);
}
