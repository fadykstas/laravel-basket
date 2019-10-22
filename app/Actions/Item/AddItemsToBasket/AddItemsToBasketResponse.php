<?php

namespace App\Actions\Item\AddItemsToBasket;


class AddItemsToBasketResponse
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
