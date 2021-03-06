<?php

namespace App\Actions\Basket\RemoveItemFromBasket;


class RemoveItemFromBasketResponse
{
    private $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function toArray(): array
    {
        return $this->array;
    }
}
