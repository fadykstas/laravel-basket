<?php

namespace App\Actions\Basket\GetBasket;

use App\Http\Resources\BasketJsonPresenter;
use App\Repositories\Contracts\BasketRepositoryInterface;

class GetBasketAction
{
    private $basketRepository;

    public function __construct(
        BasketRepositoryInterface $basketRepository
    ) {
        $this->basketRepository = $basketRepository;
    }

    public function execute(GetBasketRequest $basketRequest): GetBasketResponse
    {
        $basket = $basketRequest->getBasket();
        $basketWithContents = $this->basketRepository->getByIdWithRelations($basket->id);

        $presenter = new BasketJsonPresenter($basketWithContents);
        return new GetBasketResponse($presenter->jsonSerialize());
    }
}
