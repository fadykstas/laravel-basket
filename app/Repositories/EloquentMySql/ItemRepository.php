<?php

namespace App\Repositories\EloquentMySql;

use App\Entities\Item;
use App\Repositories\Contracts\ItemRepositoryInterface;


class ItemRepository implements ItemRepositoryInterface
{

    public function save(Item $item): Item
    {
        $item->save();
        return $item;
    }

    public function getById(int $id): ?Item
    {
        return Item::find($id);
    }

    public function deleteById(int $id): void
    {
        Item::destroy($id);
    }
}
