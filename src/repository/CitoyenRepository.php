<?php
namespace App\Repository;

use PDO;
use App\Entity\Citoyen;

class CitoyenRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }



    public function selectByCni(string $cni): ?Citoyen
    {
        $sql = "SELECT * FROM citoyen WHERE cni = :cni";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cni' => $cni]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return Citoyen::toObject($data);
        }

        return null;
    }

}
