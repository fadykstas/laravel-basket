<?php

namespace App\Actions\Basket\GetBasketList;

use App\Repositories\Contracts\BasketRepositoryInterface;

class GetBasketListAction
{
    private $basketRepository;

    public function __construct(
        BasketRepositoryInterface $basketRepository
    ) {
        $this->basketRepository = $basketRepository;
    }

    public function execute(GetBasketListRequest $basketRequest): GetBasketListResponse
    {;
        $basketsWithContents = $this->basketRepository->findAll()->all();

        return new GetBasketListResponse(...$basketsWithContents);
    }
}
