<?php

namespace App\Actions\Item\AddItemsToBasket;

use App\Entities\Item;
use App\Http\Resources\BasketJsonPresenter;
use App\Repositories\Contracts\{
    BasketRepositoryInterface,
    ItemRepositoryInterface
};
use App\Services\Contracts\TransactionServiceInterface;
use Illuminate\Support\Collection;

class AddItemsToBasketAction
{
    private $itemRepository;
    private $basketRepository;
    private $transactionService;

    public function __construct(
        BasketRepositoryInterface $basketRepository,
        ItemRepositoryInterface $itemsRepository,
        TransactionServiceInterface $transactionService
    ) {
        $this->itemRepository = $itemsRepository;
        $this->basketRepository = $basketRepository;
        $this->transactionService = $transactionService;
    }

    public function execute(AddItemsToBasketRequest $addItemsToBasketRequest): AddItemsToBasketResponse
    {
        $itemsDto = Collection::make($addItemsToBasketRequest->getItemsDto());
        $itemsDtoWeight = $itemsDto->reduce(function ($carry, AddItemDTO $item) {
            return $carry + $item->getWeight();
        });
        $basket = $addItemsToBasketRequest->getBasket();
        $basketCurrentWeight = $this->basketRepository->getBasketItemsWeight($basket);

        if ($basket->max_capacity < $itemsDtoWeight + $basketCurrentWeight) {
            throw new MaxCapacityExceededValidationException($basket->max_capacity);
        }

        $newItems = $itemsDto->map(function (AddItemDTO $itemDTO) {
            $item = new Item();
            $item->weight = $itemDTO->getWeight();
            $item->type = $itemDTO->getType();
            return $item;
        })->all();

        $this->transactionService->run(
            function () use (&$basket, $newItems) {
                $basket = $this->basketRepository->addItemsToBasket($basket, ...$newItems);
            }
        );

        $presenter = new BasketJsonPresenter($basket);
        return new AddItemsToBasketResponse($presenter->jsonSerialize());
    }
}
