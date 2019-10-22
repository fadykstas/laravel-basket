<?php

namespace App\Repositories\Contracts;


use App\Entities\Basket;
use Illuminate\Support\Collection;

interface BasketRepositoryInterface
{
    public function save(Basket $basket): Basket;

    public function getById(int $id): ?Basket;

    public function getByIdWithRelations(int $id): ?Basket;

    public function findAll(): Collection;

    public function deleteById(int $id): void;

    public function deleteAllContents(Basket $basket): Basket;
}
