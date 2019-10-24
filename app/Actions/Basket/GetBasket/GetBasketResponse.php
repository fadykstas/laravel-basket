<?php

namespace App\Actions\Basket\GetBasket;

use App\Entities\Basket;


class GetBasketResponse
{
    private $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function getBasket(): Basket
    {
        return $this->basket;
    }
}
