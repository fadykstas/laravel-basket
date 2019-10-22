<?php


namespace App\Actions\Item\AddItemsToBasket;


use Illuminate\Validation\ValidationException;

class MaxCapacityExceededValidationException extends ValidationException
{
    public function __construct(string $maxCapacity)
    {
        parent::__construct(null, null, "Max capacity of basket '{$maxCapacity}' exceeded");
    }
}
