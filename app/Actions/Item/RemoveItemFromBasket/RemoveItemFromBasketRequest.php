<?php

namespace App\Actions\Basket\RemoveItemFromBasket;

use App\Entities\Basket;
use App\Entities\Item;

class RemoveItemFromBasketRequest
{
    private $basket;
    private $item;

    public function __construct(
        Basket $basket,
        Item $item
    ) {
        $this->basket = $basket;
        $this->item = $item;
    }

    public function getBasket(): Basket
    {
        return $this->basket;
    }

    public function getItem(): Item
    {
        return $this->item;
    }
}
