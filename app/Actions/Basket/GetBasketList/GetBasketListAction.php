<?php

namespace App\Actions\Basket\GetBasketList;

use App\Http\Resources\BasketJsonPresenter;
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
        $basketWithContents = $this->basketRepository->findAll();

        $presenter = BasketJsonPresenter::collection($basketWithContents);
        return new GetBasketListResponse($presenter->jsonSerialize());
    }
}
