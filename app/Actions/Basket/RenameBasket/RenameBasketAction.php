<?php

namespace App\Actions\Basket\RenameBasket;

use App\Repositories\Contracts\BasketRepositoryInterface;
use Illuminate\Support\Facades\Log;


class RenameBasketAction
{
    private $basketRepository;

    public function __construct(
        BasketRepositoryInterface $basketRepository
    ) {
        $this->basketRepository = $basketRepository;
    }

    public function execute(RenameBasketRequest $basketRequest): RenameBasketResponse
    {
        $basket = $basketRequest->getBasket();
        $basket->name = $basketRequest->getNameNew();
        $basket = $this->basketRepository->save($basket);

        Log::info("Renamed {$basket->id}");
        return new RenameBasketResponse($basket);
    }
}
