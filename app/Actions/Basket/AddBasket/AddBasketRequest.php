<?php

namespace App\Actions\Basket\AddBasket;

class AddBasketRequest
{
    private $name;
    private $maxCapacity;

    public function __construct(
        string $name,
        int $maxCapacity
    ) {
        $this->name = $name;
        $this->maxCapacity = $maxCapacity;
    }

    public function toArray(): array
    {
        return [
            'name'    => $this->getName(),
            'capacity'  => $this->getMaxCapacity()
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMaxCapacity(): int
    {
        return $this->maxCapacity;
    }
}
