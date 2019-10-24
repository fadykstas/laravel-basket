<?php

namespace App\Http\Controllers\Api;

use App\Actions\Basket\RemoveItemFromBasket\{
    RemoveItemFromBasketAction,
    RemoveItemFromBasketRequest
};
use App\Actions\Item\AddItemsToBasket\{
    AddItemDTO,
    AddItemsToBasketAction,
    AddItemsToBasketRequest
};
use App\Entities\{
    Basket,
    Item
};
use App\Http\Requests\Item\AddItemsToBasketValidateRequest;
use App\Http\Resources\BasketJsonPresenter;
use Illuminate\Support\Collection;

class ItemController extends ApiController
{
    private $addItemsToBasketAction;
    private $removeItemFromBasketAction;

    public function __construct(
        AddItemsToBasketAction $addItemsToBasketAction,
        RemoveItemFromBasketAction $removeItemFromBasketAction
    ) {
        $this->addItemsToBasketAction = $addItemsToBasketAction;
        $this->removeItemFromBasketAction = $removeItemFromBasketAction;
    }

    public function store(Basket $basket, AddItemsToBasketValidateRequest $request)
    {
        $itemsDTO = Collection::make($request->get('items'))->map(function ($item) {
            return new AddItemDTO($item['type'], $item['weight']);
        })->all();

        $response = $this->addItemsToBasketAction->execute(
            new AddItemsToBasketRequest(
                $basket,
                ...$itemsDTO
            )
        );
        $presenter = new BasketJsonPresenter($response->getBasket());

        return $this->successResponse($presenter->jsonSerialize());
    }

    public function destroy(Basket $basket, Item $item)
    {
        $response = $this->removeItemFromBasketAction->execute(
            new RemoveItemFromBasketRequest(
                $basket,
                $item
            )
        );

        return $this->successResponse($response->toArray());
    }
}
