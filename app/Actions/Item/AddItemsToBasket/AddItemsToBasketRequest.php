<?php

namespace App\Actions\Item\AddItemsToBasket;

use App\Entities\Basket;

class AddItemsToBasketRequest
{
    private $basket;
    private $itemsDto;

    public function __construct(
        Basket $basket,
        AddItemDTO ...$itemsDto
    ) {
        $this->basket = $basket;
        $this->itemsDto = $itemsDto;
    }

    public function getBasket(): Basket
    {
        return $this->basket;
    }

    public function getItemsDto(): array
    {
        return $this->itemsDto;
    }


}
