<?php

namespace App\Actions\Basket\RemoveBasket;

use App\Repositories\Contracts\BasketRepositoryInterface;
use App\Services\Contracts\TransactionServiceInterface;
use Illuminate\Support\Facades\Log;


class RemoveBasketAction
{
    private $transactionService;
    private $basketRepository;

    public function __construct(
        BasketRepositoryInterface $basketRepository,
        TransactionServiceInterface $transactionService
    ) {

        $this->basketRepository = $basketRepository;
        $this->transactionService = $transactionService;
    }

    public function execute(RemoveBasketRequest $basketRequest): RemoveBasketResponse
    {
        return $this->transactionService->run(
            function () use ($basketRequest) {
                $basket = $this->basketRepository->deleteAllContents($basketRequest->getBasket());
                $this->basketRepository->deleteById($basket->id);

                Log::info("Deleted {$basket->id}");
                return new RemoveBasketResponse();
            });
    }
}
