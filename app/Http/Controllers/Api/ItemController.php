<?php

namespace App\Http\Controllers\Api;

use App\Entities\Basket;
use App\Entities\Item;
use Illuminate\Http\Request;

class ItemController extends ApiController
{
    public function store(Basket $basket, Request $request)
    {
//        $basket->toArray(), $request->all()
        return $this->successResponse([
            'basket'=>$basket->toArray(),
            'request'=>$request->all()
        ]);
    }

    public function destroy(Basket $basket, Item $item)
    {
        //
    }
}
