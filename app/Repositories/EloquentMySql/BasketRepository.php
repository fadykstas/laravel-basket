<?php

namespace App\Repositories\EloquentMySql;


use App\Entities\{
    Basket,
    Item
};
use App\Repositories\Contracts\BasketRepositoryInterface;
use Illuminate\Support\Collection;

class BasketRepository implements BasketRepositoryInterface
{

    public function save(Basket $basket): Basket
    {
        $basket->save();
        return $basket;
    }

    public function getById(int $id): ?Basket
    {
        return Basket::find($id);
    }

    public function getByIdWithRelations(int $id): ?Basket
    {
        return Basket::with(['contents'])->where(['id' => $id])->first();
    }

    public function findAll(): Collection
    {
        return Basket::with(['contents'])->get();
    }

    public function deleteById(int $id): void
    {
        Basket::destroy($id);
    }

    public function deleteAllContents(Basket $basket): Basket
    {
        $basket->contents()->delete();
        $basket->save();
        return $basket;
    }

    public function getBasketItemsWeight(Basket $basket): int
    {
        return $basket->contents()->sum('weight');
    }


    public function addItemsToBasket(Basket $basket, Item ...$items): Basket
    {
        Collection::make($items)->each(function (Item $itemNew) use ($basket){
            $itemOld = $basket->contents()->get()->filter(function (Item $itemOld) use ($itemNew) {
                return $itemOld->type == $itemNew->type;
            })->first();
            if ($itemOld) {
                $itemOld->weight = $itemOld->weight + $itemNew->weight;
                $itemOld->save();
            } else {
                $basket->contents()->save($itemNew);
            }
        });;

        return $basket;
    }

    public function deleteItemFromBasket(Basket $basket, Item $item): Basket
    {
        $basket->contents()->find($item->id)->delete();

        return $basket;
    }
}
