<?php

namespace App\Actions\Basket\AddBasket;

use App\Entities\Basket;
use App\Repositories\Contracts\BasketRepositoryInterface;
use Illuminate\Support\Facades\Log;


class AddBasketAction
{
    private $basketRepository;

    public function __construct(
        BasketRepositoryInterface $basketRepository
    ) {
        $this->basketRepository = $basketRepository;
    }

    public function execute(AddBasketRequest $basketRequest): AddBasketResponse
    {
        $basket = new Basket();
        $basket->name = $basketRequest->getName();
        $basket->max_capacity = $basketRequest->getMaxCapacity();

        $this->basketRepository->save($basket);

        Log::info("Added {$basket->id}");
        return new AddBasketResponse($basket);
    }
}
