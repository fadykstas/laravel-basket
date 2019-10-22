<?php

namespace App\Actions\Basket\AddBasket;

use App\Entities\Basket;

class AddBasketResponse
{
    private $id;
    private $name;
    private $maxCapacity;

    public function __construct(Basket $basket)
    {
        $this->id = $basket->id;
        $this->name = $basket->name;
        $this->maxCapacity = $basket->max_capacity;
    }

    public function toArray(): array
    {
        return [
            'id'        => $this->getId(),
            'name'      => $this->getName(),
            'maxCapacity'  => $this->getMaxCapacity()
        ];
    }

    public function getId(): int
    {
        return $this->id;
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
