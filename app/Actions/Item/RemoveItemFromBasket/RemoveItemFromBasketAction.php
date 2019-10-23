<?php

namespace App\Actions\Basket\RemoveItemFromBasket;

use App\Http\Resources\BasketJsonPresenter;
use App\Repositories\Contracts\BasketRepositoryInterface;


class RemoveItemFromBasketAction
{
    private $basketRepository;

    public function __construct(
        BasketRepositoryInterface $basketRepository
    ) {
        $this->basketRepository = $basketRepository;
    }

    public function execute(RemoveItemFromBasketRequest $basketRequest): RemoveItemFromBasketResponse
    {
        $basket = $basketRequest->getBasket();
        $item =$basketRequest->getItem();

        $this->basketRepository->deleteItemFromBasket($basket, $item);
        $basketWithContents = $this->basketRepository->getByIdWithRelations($basket->id);

        $presenter = new BasketJsonPresenter($basketWithContents);
        return new RemoveItemFromBasketResponse($presenter->jsonSerialize());
    }
}
