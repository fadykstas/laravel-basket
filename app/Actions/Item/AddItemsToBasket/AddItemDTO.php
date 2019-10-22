<?php


namespace App\Actions\Item\AddItemsToBasket;


class AddItemDTO
{
    private $type;
    private $weight;

    public function __construct(
        string $type,
        int $weight
    ) {

        $this->type = $type;
        $this->weight = $weight;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }


}
