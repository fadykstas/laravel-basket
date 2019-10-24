<?php

namespace App\Actions\Item\AddItemsToBasket;

use App\Entities\Basket;


class AddItemsToBasketResponse
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
