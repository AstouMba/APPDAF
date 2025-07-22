<?php
namespace App\Core\abstract;

use App\Entity\Response;

abstract class AbstractController
{
    public function renderJson(Response $response): void
    {
        $responseArray = $response->toArray();

        header('Content-Type: application/json; charset=utf-8');
        http_response_code((int)$responseArray['code']);

        echo json_encode($responseArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    abstract public function show();
}
