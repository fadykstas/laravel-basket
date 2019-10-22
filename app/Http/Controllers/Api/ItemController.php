<?php

namespace App\Http\Controllers\Api;

use App\Actions\Item\AddItemsToBasket\AddItemDTO;
use App\Actions\Item\AddItemsToBasket\AddItemsToBasketAction;
use App\Actions\Item\AddItemsToBasket\AddItemsToBasketRequest;
use App\Entities\Basket;
use App\Entities\Item;
use App\Http\Requests\Item\AddItemsToBasketValidateRequest;

use Illuminate\Support\Collection;

class ItemController extends ApiController
{
    private $addItemsToBasketAction;

    public function __construct(
        AddItemsToBasketAction $addItemsToBasketAction
    ) {
        $this->addItemsToBasketAction = $addItemsToBasketAction;
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

        return $this->successResponse($response->toArray());
    }

    public function destroy(Basket $basket, Item $item)
    {
        //
    }
}
