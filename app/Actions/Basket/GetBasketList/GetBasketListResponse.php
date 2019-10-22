<?php

namespace App\Actions\Basket\GetBasketList;


class GetBasketListResponse
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
