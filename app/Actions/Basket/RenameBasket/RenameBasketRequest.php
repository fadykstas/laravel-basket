<?php

namespace App\Actions\Basket\RenameBasket;

use App\Entities\Basket;

class RenameBasketRequest
{
    private $basket;
    private $nameNew;

    public function __construct(
        Basket $basket,
        string $name
    ) {
        $this->basket = $basket;
        $this->nameNew = $name;
    }

    public function getBasket(): Basket
    {
        return $this->basket;
    }

    public function getNameNew(): string
    {
        return $this->nameNew;
    }
}
