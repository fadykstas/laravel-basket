<?php

namespace App\Repositories\EloquentMySql;


use App\Entities\Basket;
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
}
