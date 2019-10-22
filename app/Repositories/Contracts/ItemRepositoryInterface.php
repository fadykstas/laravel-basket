<?php

namespace App\Repositories\Contracts;

use App\Entities\Item;


interface ItemRepositoryInterface
{
    public function save(Item $item): Item;

    public function getById(int $id): ?Item;

    public function deleteById(int $id): void;
}
