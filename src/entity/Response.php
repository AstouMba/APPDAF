<?php
namespace App\Entity;

use App\Core\SetterGetter;
use App\Entity\StatutEnum;
use App\Entity\Citoyen;

class Response extends SetterGetter
{
    protected ?Citoyen $data;
    protected StatutEnum $statut;
    protected int $code;
    protected string $message;

    public function __construct(
        ?Citoyen $data,
        StatutEnum $statut,
        int $code,
        string $message
    ) {
        $this->data = $data;
        $this->statut = $statut;
        $this->code = $code;
        $this->message = $message;
    }

    public static function toObject(array $array): static
    {
        return new static(
            isset($array['data']) ? Citoyen::toObject($array['data']) : null,
            StatutEnum::from($array['statut']),
            (int)$array['code'],
            $array['message']
        );
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data?->toArray(),
            'statut' => $this->statut->value,
            'code' => $this->code,
            'message' => $this->message,
        ];
    }
}
