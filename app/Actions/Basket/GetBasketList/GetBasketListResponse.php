<?php

namespace App\Actions\Basket\GetBasketList;

use App\Entities\Basket;
use Illuminate\Support\Collection;

class GetBasketListResponse
{
    private $baskets;

    public function __construct(Basket ...$baskets)
    {
        $this->baskets = Collection::make($baskets);
    }

    public function getBaskets(): Collection
    {
        return $this->baskets;
    }
}
