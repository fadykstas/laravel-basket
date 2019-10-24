<?php

namespace App\Http\Controllers\Api;

use App\Actions\Basket\AddBasket\{
    AddBasketAction,
    AddBasketRequest
};
use App\Http\Requests\Basket\{
    RenameBasketValidateRequest,
    AddNewBasketValidateRequest
};
use App\Actions\Basket\GetBasketList\{
    GetBasketListAction,
    GetBasketListRequest
};
use App\Actions\Basket\GetBasket\{
    GetBasketAction,
    GetBasketRequest
};
use App\Actions\Basket\RemoveBasket\{
    RemoveBasketAction,
    RemoveBasketRequest
};
use App\Actions\Basket\RenameBasket\{
    RenameBasketAction,
    RenameBasketRequest
};
use App\Entities\Basket;
use App\Http\Resources\BasketJsonPresenter;
use Illuminate\Http\JsonResponse;

class BasketController extends ApiController
{
    private $addBasketAction;
    private $removeBasketAction;
    private $renameBasketAction;
    private $getBasketAction;
    private $getBasketListAction;

    public function __construct(
        AddBasketAction $addBasketAction,
        RemoveBasketAction $removeBasketAction,
        RenameBasketAction $renameBasketAction,
        GetBasketAction $getBasketAction,
        GetBasketListAction $getBasketListAction
    ) {
        $this->addBasketAction = $addBasketAction;
        $this->removeBasketAction = $removeBasketAction;
        $this->renameBasketAction = $renameBasketAction;
        $this->getBasketAction = $getBasketAction;
        $this->getBasketListAction = $getBasketListAction;
    }

    public function index(): JsonResponse
    {
        $response = $this->getBasketListAction->execute(
            new GetBasketListRequest()
        );
        $presenter = BasketJsonPresenter::collection($response->getBaskets());

        return $this->successResponse($presenter->jsonSerialize());
    }


    public function store(AddNewBasketValidateRequest $request): JsonResponse
    {
        $response = $this->addBasketAction->execute(
            new AddBasketRequest(
                $request->get('name'),
                $request->get('maxCapacity')
            )
        );

        return $this->successResponse($response->toArray());
    }

    public function show(Basket $basket)
    {
        $response = $this->getBasketAction->execute(
            new GetBasketRequest(
                $basket
            )
        );
        $presenter = new BasketJsonPresenter($response->getBasket());

        return $this->successResponse($presenter->jsonSerialize());
    }

    public function update(RenameBasketValidateRequest $request, Basket $basket): JsonResponse
    {
        $response = $this->renameBasketAction->execute(
            new RenameBasketRequest(
                $basket,
                $request->get('name')
            )
        );

        return $this->successResponse($response->toArray());
    }

    public function destroy(Basket $basket): JsonResponse
    {
        $this->removeBasketAction->execute(
            new RemoveBasketRequest(
                $basket
            )
        );

        return $this->emptyResponse();
    }
}
