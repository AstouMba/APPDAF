<?php
namespace App\Repository;

use PDO;
use App\Entity\Log;

class LogRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function insert(Log $log): int
    {
        $sql = "INSERT INTO logs (date, heure, localisation, statut, ip_address)
            VALUES (:date, :heure, :localisation, :statut, :ip_address)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($log->toArray());

        return (int) $this->pdo->lastInsertId();
    }

}
