<?php
namespace App\Entity;

use App\Core\abstract\AbstractEntity;

class Citoyen extends AbstractEntity {
    private ?int $id = null;
    private string $nom;
    private string $prenom;
    private string $date_naissance;
    private string $lieu_naissance;
    private string $cni;
    private string $cni_recto_url;
    private string $cni_verso_url;

    public function __construct(
        string $nom,
        string $prenom,
        string $date_naissance,
        string $lieu_naissance,
        string $cni,
        string $cni_recto_url,
        string $cni_verso_url
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->lieu_naissance = $lieu_naissance;
        $this->cni = $cni;
        $this->cni_recto_url = $cni_recto_url;
        $this->cni_verso_url = $cni_verso_url;
    }

    public static function toObject(array $data): static {
        $citoyen = new static(
            $data['nom'],
            $data['prenom'],
            $data['date_naissance'],
            $data['lieu_naissance'],
            $data['cni'],
            $data['cni_recto_url'],
            $data['cni_verso_url']
        );

        return $citoyen;
    }

    public function toArray(): array {
        return [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'date_naissance' => $this->date_naissance,
            'lieu_naissance' => $this->lieu_naissance,
            'cni' => $this->cni,
            'cni_recto_url' => $this->cni_recto_url,
            'cni_verso_url' => $this->cni_verso_url,
        ];
    }
}
