<?php

namespace App\Actions\Basket\RemoveBasket;

use App\Entities\Basket;

class RemoveBasketRequest
{
    private $basket;

    public function __construct(
        Basket $basket
    ) {
        $this->basket = $basket;
    }

    public function getBasket(): Basket
    {
        return $this->basket;
    }
}
