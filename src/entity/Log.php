<?php
namespace App\Entity;

use App\Core\abstract\AbstractEntity;
use App\Entity\StatutEnum;

class Log extends AbstractEntity {
    private string $date;
    private string $heure;
    private string $localisation;
    private StatutEnum $statut;
    private string $ip_address;

    public function __construct(
        string $date,
        string $heure,
        string $localisation,
        StatutEnum $statut,
        string $ip_address
    ) {
        $this->date = $date;
        $this->heure = $heure;
        $this->localisation = $localisation;
        $this->statut = $statut;
        $this->ip_address = $ip_address;
    }


    
    public static function toObject(array $data): static {
        return new self(
            $data['date'],
            $data['heure'],
            $data['localisation'],
            StatutEnum::from($data['statut']),
            $data['ip_address']
        );
    }

    public function toArray(): array {
        return [
            'date'         => $this->date,
            'heure'        => $this->heure,
            'localisation' => $this->localisation,
            'statut'       => $this->statut->value,
            'ip_address'   => $this->ip_address
        ];
    }
}
